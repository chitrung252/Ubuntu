<?php
class ModelDashboardDashboard extends Model {
	
    #call related product
	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) ORDER BY p.product_id DESC LIMIT 0,5 ";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	#call related order
	public function getOrders($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) ";
		$sql .=" GROUP BY o.order_id";
		$sql .=" ORDER BY o.order_id DESC LIMIT 0,5 ";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getSubtotal($order_id) {
		
		$query = $this->db->query("SELECT SUM(total) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
		
	}
    #call sum order
	public function getTotalorderprice() {
		$query = $this->db->query("SELECT SUM(price) AS total FROM " . DB_PREFIX . "order_product");

		return $query->row['total'];

	}
	public function getTotalorderproduct() {
		$query = $this->db->query("SELECT COUNT(order_id) AS total FROM " . DB_PREFIX . "order");

		return $query->row['total'];

	}
	public function getTotalorderquantity() {
		$query = $this->db->query("SELECT SUM(quantity_order) AS total FROM " . DB_PREFIX . "order_product");

		return $query->row['total'];

	}
	public function getTotalproduct() {
		$query = $this->db->query("SELECT SUM(quantity) AS total FROM " . DB_PREFIX . "product");

		return $query->row['total'];

	}
	 #call sum customer
	public function getTotalcustomer() {
		$query = $this->db->query("SELECT COUNT(customer_id) AS total FROM " . DB_PREFIX . "customer");

		return $query->row['total'];

	}
	# call sp mua nhieu
	public function getSanphamuanhieu($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order_product";
		$sql .=" GROUP BY product_id";
		$sql .=" ORDER BY quantity_order DESC LIMIT 0,5 ";
		$query = $this->db->query($sql);

		return $query->rows;
	}
}
