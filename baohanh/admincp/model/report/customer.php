<?php
class ModelReportCustomer extends Model {
	public function getCustomer($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order ";

        $sql .= " ORDER BY order_id DESC";
		
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
	
	public function getTotalCustomer($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order`";
        //$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.status > '0'";
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}