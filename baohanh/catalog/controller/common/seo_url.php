<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}

			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);

					if ($url[0] == 'book_id') {
						$this->request->get['book_id'] = $url[1];
					}
					
					if ($url[0] == 'book_category_id') {
						if (!isset($this->request->get['path_b'])) {
							$this->request->get['path_b'] = $url[1];
						} else {
							$this->request->get['path_b'] .= '_' . $url[1];
						}
					}
					
					if ($url[0] == 'elearning_id') {
						$this->request->get['elearning_id'] = $url[1];
					}
                    if ($url[0] == 'elearning_category_id') {
						if (!isset($this->request->get['path_e'])) {
							$this->request->get['path_e'] = $url[1];
						} else {
							$this->request->get['path_e'] .= '_' . $url[1];
						}
					}
					
					if ($url[0] == 'faqs_category_id') {
						if (!isset($this->request->get['path_f'])) {
							$this->request->get['path_f'] = $url[1];
						} else {
							$this->request->get['path_f'] .= '_' . $url[1];
						}
					}
					
					
					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}
					
					
					if ($url[0] == 'information_category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}
                  
					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'information_category_id' && $url[0] != 'book_id' && $url[0] != 'book_category_id' && $url[0] != 'elearning_id' && $url[0] != 'elearning_category_id'
					&& $url[0] != 'faqs_category_id') {
						$this->request->get['route'] = $query->row['query'];
					}
				} else {
					$this->request->get['route'] = 'error/not_found';

					break;
				}
			}

			if (!isset($this->request->get['route'])) {
				
				if (isset($this->request->get['information_id'])) {
					$this->request->get['route'] = 'information/information';
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'information/category';
				}
				
				if (isset($this->request->get['elearning_id'])) {
					$this->request->get['route'] = 'elearning/elearning';
				} elseif (isset($this->request->get['path_e'])) {
					$this->request->get['route'] = 'elearning/category';
				}
				
				if (isset($this->request->get['path_f'])) {
					$this->request->get['route'] = 'faqs/category';
				}
				
				if (isset($this->request->get['book_id'])) {
					$this->request->get['route'] = 'book/book';
				} elseif (isset($this->request->get['path_b'])) {
					$this->request->get['route'] = 'book/category';
				}
			 }
			

			if (isset($this->request->get['route'])) {
				return new Action($this->request->get['route']);
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));

		$url = '';

		$data = array();

		parse_str($url_info['query'], $data);

		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'information/information' && $key == 'information_id') || ($data['route'] == 'book/book' && $key == 'book_id') 
					|| ($data['route'] == 'elearning/elearning' && $key == 'elearning_id'))
				{
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}
				} elseif ($key == 'path') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'information_category_id=" . (int)$category . "'");
						
						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
				// rewrite book
				elseif ($key == 'path_b') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'book_category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
				//rewrite elearning
				elseif ($key == 'path_e') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'elearning_category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
				//rewrite faqs
				elseif ($key == 'path_f') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'faqs_category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
				
			}
		
		}
		
		

		if ($url) {
			unset($data['route']);

			$query = '';

			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((string)$value);
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}
}
