<?php
class ModelCatalogInformation extends Model {
	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");

		return $query->row;
	}
  
  
	public function getInformations() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1' ORDER BY i.sort_order, LCASE(id.title) ASC");

		return $query->rows;
	}

	public function getInformationLayoutId($information_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}
  
  public function updateViewed($information_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "information SET viewed = (viewed + 1) WHERE information_id = '" . (int)$information_id . "'");
	}
  
  public function getTotalInformations($data = array()) {
    
    $group_id = $this->customer->getGroupId();
    $user_id = $this->customer->getId();
    
		$sql = "SELECT COUNT(DISTINCT i.information_id) AS total";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "information_category_path cp LEFT JOIN " . DB_PREFIX . "information_to_category i2c ON (cp.category_id = i2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "information_to_category i2c";
			}

			$sql .= " LEFT JOIN " . DB_PREFIX . "information i ON (i2c.information_id = i.information_id)";

		} else {
			$sql .= " FROM " . DB_PREFIX . "information i";
		}
    
    $sql .= " LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)";
    
    if (!empty($user_id)) {
      $sql .=" LEFT JOIN " . DB_PREFIX . "allowed_groups ag ON (i.information_id = ag.object_id AND ag.object_type = '".
      TYPE_INFORMATION."' AND ag.group_id IN (-1,-3, " . $group_id . ")) LEFT JOIN " .
      DB_PREFIX . "denied_groups dg ON (i.information_id = dg.object_id AND dg.object_type = '".
      TYPE_INFORMATION."' AND dg.group_id IN (-1,-3, " . $group_id . ")) LEFT JOIN " .
      DB_PREFIX . "allowed_users au ON (i.information_id = au.object_id AND au.object_type = '".
      TYPE_INFORMATION."' AND au.user_id = '" . $user_id . "') LEFT JOIN " .
      DB_PREFIX . "denied_users du ON (i.information_id = du.object_id AND du.object_type = '".
      TYPE_INFORMATION."' AND du.user_id = '" . $user_id . "') WHERE (!(ag.group_id IS NULL) OR !(au.user_id IS NULL)) AND dg.group_id IS NULL AND du.user_id IS NULL AND";    
    } else {
      $sql .=" LEFT JOIN " . DB_PREFIX . "allowed_groups ag ON (i.information_id = ag.object_id AND ag.object_type = '".TYPE_INFORMATION."' AND ag.group_id IN (-1,-2)) LEFT JOIN " . DB_PREFIX . "denied_groups dg ON (i.information_id = dg.object_id AND dg.object_type = '".TYPE_INFORMATION."' AND dg.group_id IN (-1,-2)) WHERE !(ag.group_id IS NULL) AND dg.group_id IS NULL AND";    
    }
    
    $sql .= " id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
    //$sql .= " LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
    
		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND i2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "id.title LIKE '%" . $this->db->escape($word) . "%'";
                    $implode_description[] = "id.description LIKE '%" . $this->db->escape($word) . "%'"; 
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					//$sql .= " OR id.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
          $sql .= " OR (";
          $sql .= " " . implode(" AND ", $implode_description) . "";
          $sql .= ")";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "id.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
			}

			$sql .= ")";
		}
    
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
  
  public function getInformations_2($data = array()) {
  
    $group_id = $this->customer->getGroupId();
    $user_id = $this->customer->getId();
    
		$sql = "SELECT i.information_id";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "information_category_path cp LEFT JOIN " . DB_PREFIX . "information_to_category i2c ON (cp.category_id = i2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "information_to_category i2c";
			}
			
			$sql .= " LEFT JOIN " . DB_PREFIX . "information i ON (i2c.information_id = i.information_id)";

		} else {
			$sql .= " FROM " . DB_PREFIX . "information i";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)";
    
    if (!empty($user_id)) {
      $sql .=" LEFT JOIN " . DB_PREFIX . "allowed_groups ag ON (i.information_id = ag.object_id AND ag.object_type = '".
      TYPE_INFORMATION."' AND ag.group_id IN (-1,-3, " . $group_id . ")) LEFT JOIN " .
      DB_PREFIX . "denied_groups dg ON (i.information_id = dg.object_id AND dg.object_type = '".
      TYPE_INFORMATION."' AND dg.group_id IN (-1,-3, " . $group_id . ")) LEFT JOIN " .
      DB_PREFIX . "allowed_users au ON (i.information_id = au.object_id AND au.object_type = '".
      TYPE_INFORMATION."' AND au.user_id = '" . $user_id . "') LEFT JOIN " .
      DB_PREFIX . "denied_users du ON (i.information_id = du.object_id AND du.object_type = '".
      TYPE_INFORMATION."' AND du.user_id = '" . $user_id . "') WHERE (!(ag.group_id IS NULL) OR !(au.user_id IS NULL)) AND dg.group_id IS NULL AND du.user_id IS NULL AND";    
    } else {
      $sql .=" LEFT JOIN " . DB_PREFIX . "allowed_groups ag ON (i.information_id = ag.object_id AND ag.object_type = '".TYPE_INFORMATION."' AND ag.group_id IN (-1,-2)) LEFT JOIN " . DB_PREFIX . "denied_groups dg ON (i.information_id = dg.object_id AND dg.object_type = '".TYPE_INFORMATION."' AND dg.group_id IN (-1,-2)) WHERE !(ag.group_id IS NULL) AND dg.group_id IS NULL AND";    
    }
    
    $sql .= " id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND i2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}
			
		}

    if (!empty($data['filter_bottom'])) {
      $sql .= " AND i.bottom = '1'";
    }

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "id.title LIKE '%" . $this->db->escape($word) . "%'";
          $implode_description[] = "id.description LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					//$sql .= " OR id.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
          $sql .= " OR (";
          $sql .= " " . implode(" AND ", $implode_description) . "";
          $sql .= ")";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "id.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			$sql .= ")";
		}
 
		$sql .= " GROUP BY i.information_id";
		$sort_data = array(
			'id.title',
			'i.sort_order',
			'i.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'id.title') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY i.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(id.title) DESC";
		} else {
			$sql .= " ASC, LCASE(id.title) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
       
		$information_data = array();
     
		$query = $this->db->query($sql);
		
    foreach ($query->rows as $result) {
			$information_data[$result['information_id']] = $this->getInformation($result['information_id']);
		}
    
		return $information_data;
    
    
    //return $query->rows;
    
	}
  
  public function getInformationRelated($information_id) {
		$information_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_related ir LEFT JOIN " . DB_PREFIX . "information i ON (ir.related_id = i.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE ir.information_id = '" . (int)$information_id . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) {
      if ($this->model_setting_rights->getRight($result['related_id'], TYPE_INFORMATION)) {
			 $information_data[$result['related_id']] = $this->getInformation($result['related_id']);
      }
		}

		return $information_data;
	}
	
	public function getInformationRelateds($information_id) {
	 $information_data = array();
	 $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_category i2c LEFT JOIN " . DB_PREFIX . "information i ON (i2c.information_id = i.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i2c.category_id IN (SELECT category_id FROM " . DB_PREFIX . "information_to_category WHERE information_id = '" . (int)$information_id . "') AND i.information_id != '" . (int)$information_id . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY RAND() LIMIT 0, 4"); 
	 
	 foreach ($query->rows as $result) {
      if ($result['information_id']) {
			 $information_data[$result['information_id']] = $this->getInformation($result['information_id']);
      }
		}

		return $information_data;
  }
  
}