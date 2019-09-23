<?php
class ModelSaleOrder extends Model {
	public function addOrder($data) {
		$this->event->trigger('pre.admin.order.add', $data);

		$this->db->query(
		"INSERT INTO " . DB_PREFIX . "order SET customer_name = '" . $this->db->escape(trim($data['customer'])) . "',
		customer_id = '" . (int)$data['customer_id'] . "',
		address = '" . $this->db->escape(trim($data['address'])) . "',
		telephone = '" . $this->db->escape(trim($data['telephone'])) . "',
		status = '" . (int)$data['status'] . "',
		date_added = '" . $this->db->escape(trim($data['date_added'])) . "'"
		);

		$order_id = $this->db->getLastId();

	   if (isset($data['product_order'])) {
			foreach ($data['product_order'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', 
				product_id = '" . (int)$product_id['product_id'] . "', 
				quantity_order = '" . (int)$product_id['quantity_order'] . "', 
				imei = '" . $this->db->escape(($product_id['imei'])) . "',
                codecolor = '" . $this->db->escape(($product_id['codecolor'])) . "',  				
				price = '" . (float)$product_id['price'] . "', 
				total = '" . (float)$product_id['total'] . "',
				manufacturer = '" . $this->db->escape(($product_id['manufacturer'])) . "',
				guarantee = '" . $this->db->escape(($product_id['guarantee'])) . "',
				website = '" . $this->db->escape(($product_id['website'])) . "',
				image = '" . $this->db->escape(($product_id['image'])) . "',
				name_product = '" . $this->db->escape(($product_id['name_product'])) . "'");
			}
		}
		
		$this->cache->delete('order');

		$this->event->trigger('post.admin.order.add', $order_id);

		return $order_id;
	}

	public function editOrder($order_id, $data) {
		$this->event->trigger('pre.admin.order.edit', $data);

		 $this->db->query(
		"UPDATE " . DB_PREFIX . "order SET customer_name = '" . $this->db->escape(trim($data['customer_name'])) . "',
		customer_id = '" . (int)$data['customer_id'] . "',
		address = '" . $this->db->escape(trim($data['address'])) . "',
		telephone = '" . $this->db->escape(trim($data['telephone'])) . "',
		status = '" . (int)$data['status'] . "',
		date_added = '" . $this->db->escape(trim($data['date_added'])) . "' WHERE order_id = '" . (int)$order_id . "'"
		);


		$this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['product_order'])) {
			foreach ($data['product_order'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', 
				product_id = '" . (int)$product_id['product_id'] . "', 
				quantity_order = '" . (int)$product_id['quantity_order'] . "', 
				imei = '" . $this->db->escape(($product_id['imei'])) . "',
				codecolor = '" . $this->db->escape(($product_id['codecolor'])) . "',
				price = '" . (float)$product_id['price'] . "', 
				total = '" . (float)$product_id['total'] . "',
				manufacturer = '" . $this->db->escape(($product_id['manufacturer'])) . "',
				guarantee = '" . $this->db->escape(($product_id['guarantee'])) . "',
				website = '" . $this->db->escape(($product_id['website'])) . "',
				image = '" . $this->db->escape(($product_id['image'])) . "',
				name_product = '" . $this->db->escape(($product_id['name_product'])) . "'");
			}
		}
		
		$this->cache->delete('order');

		$this->event->trigger('post.admin.order.edit', $order_id);
	}

	

	public function deleteOrder($order_id) {
		$this->event->trigger('pre.admin.order.delete', $order_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
		$this->cache->delete('order');

		$this->event->trigger('post.admin.order.delete', $order_id);
	}

	public function getOrder($order_id) {
	
       $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.order_id = '" . (int)$order_id . "'");
	   
		
		return $query->row;
	}

	public function getOrders($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.status > '0'";

        
		if (!empty($data['filter_order_id'])) {
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

        if (!empty($data['filter_customer'])) {
			$sql .= " AND o.customer_name LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}
		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND o.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND o.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND o.status = '" . (int)$data['filter_status'] . "'";
		} 
		
		$sql .= " GROUP BY o.order_id";
        $sql .= " ORDER BY o.order_id DESC";
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		$query = $this->db->query($sql);

		return $query->rows;
	}



	public function getTotalorders($data = array()) {

        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.status > '0'";
		
		if (!empty($data['filter_order_id'])) {
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		}
		
       if (!empty($data['filter_customer'])) {
			$sql .= " AND o.customer_name LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND o.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND o.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND o.status = '" . (int)$data['filter_status'] . "'";
		} 

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	/*public function getOrderInfor($order_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.order_id = '" . (int)$order_id . "'");
		
		return $query->rows;
	}*/
	public function getOrderInfor($order_id) {
        $sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.order_id = '" . (int)$order_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getOrderInfor_1($order_id) {
        $sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.order_id = '" . (int)$order_id . "'";
		$sql .= " GROUP BY o.customer_id";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getOrderProducts($order_id) {

		//$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id)  WHERE o.order_id = '" . (int)$order_id . "'");
		
		return $query->rows;
	}
	
	public function getSubtotal($order_id) {
		
		$query = $this->db->query("SELECT SUM(total) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
		
	}
	

 
   public function getProducts($data = array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN ". DB_PREFIX . "guarantee g ON (p.guarantee_id = g.guarantee_id)";
		$query = $this->db->query($sql);

		return $query->rows;
	}

}
