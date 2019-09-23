<?php
class ModelCatalogSearch extends Model {
	
	 public function getSearch($search) {
	   
		$sql = "SELECT *";
	    $sql .= " FROM " . DB_PREFIX . "order o";
		$sql .= " LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id)";
		$sql .= " WHERE telephone LIKE '%$search%'" ;
		$sql .= " OR" ;
		$sql .= " imei LIKE '%$search'" ;
	    $sql .= " LIMIT 0,2" ;
		
        $query = $this->db->query($sql);
		return $query->rows;
	}
  
}