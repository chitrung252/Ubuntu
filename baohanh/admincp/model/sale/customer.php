<?php
class ModelSaleCustomer extends Model {
	public function addCustomer($data) {
		$this->event->trigger('pre.admin.customer.add', $data);

		$this->db->query(
		"INSERT INTO " . DB_PREFIX . "customer SET customer_name = '" . $this->db->escape(trim($data['customer_name'])) . "',
		address = '" . $this->db->escape(trim($data['address'])) . "',
		telephone = '" . $this->db->escape(trim($data['telephone'])) . "',
		status = '" . (int)$data['status'] . "',
		date_added = NOW()"
		);

		$customer_id = $this->db->getLastId();

		$this->cache->delete('customer');

		$this->event->trigger('post.admin.customer.add', $customer_id);

		return $customer_id;
	}

	public function editCustomer($customer_id, $data) {
		$this->event->trigger('pre.admin.customer.edit', $data);
		 $this->db->query(
		"UPDATE " . DB_PREFIX . "customer SET customer_name = '" . $this->db->escape(trim($data['customer_name'])) . "',
		address = '" . $this->db->escape(trim($data['address'])) . "',
		telephone = '" . $this->db->escape(trim($data['telephone'])) . "',
		status = '" . (int)$data['status'] . "'
		WHERE customer_id = '" . (int)$customer_id . "'"
		);
		$this->cache->delete('customer');

		$this->event->trigger('post.admin.customer.edit', $customer_id);
	}

	public function deleteCustomer($customer_id) {
		$this->event->trigger('pre.admin.customer.delete', $customer_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		
		$this->cache->delete('customer');

		$this->event->trigger('post.admin.customer.delete', $customer_id);
	}

	

	public function getCustomer($customer_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "customer_path cp LEFT JOIN " . DB_PREFIX . "customer_description cd1 ON (cp.path_id = cd1.customer_id AND cp.customer_id != cp.path_id) WHERE cp.customer_id = c.customer_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.customer_id) AS path FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_description cd2 ON (c.customer_id = cd2.customer_id) WHERE c.customer_id = '" . (int)$customer_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		return $query->row;
	}

	public function getCustomers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customer c WHERE c.status >= '0'";
        
		if (!empty($data['filter_customer_name'])) {
			$sql .= " AND c.customer_name LIKE '%" . $this->db->escape($data['filter_customer_name']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$sql .= " AND c.telephone LIKE '%" . $this->db->escape($data['filter_telephone']) . "%'";
		}
		$sql .= "ORDER BY c.customer_id DESC";
		
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

	

	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer c WHERE c.status > '0'";
		
        if (!empty($data['filter_customer_name'])) {
			$sql .= " AND c.customer_name LIKE '" . $this->db->escape($data['filter_customer_name']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$sql .= " AND c.telephone LIKE '" . $this->db->escape($data['filter_telephone']) . "%'";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
		
}
