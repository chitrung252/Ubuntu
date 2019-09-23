<?php
class ModelReportProductviewed extends Model {
	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order_product ";

        $sql .=" GROUP BY product_id";
		$sql .=" ORDER BY quantity_order DESC ";
		
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
	
	public function getTotalproduct($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_product ";
        //$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.status > '0'";
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	public function getTotalquantity($order_id) {
		
		$query = $this->db->query("SELECT SUM(quantity_order) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
		
	}
}