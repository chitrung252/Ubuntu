<?php
class ModelCatalogReview extends Model {
	public function addReview($information_id, $data) {
		$this->event->trigger('pre.review.add', $data);
    
		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', information_id = '" . (int)$information_id . "', text = '" . $this->db->escape($data['text']) . "', status = '" . (int)$this->config->get('config_comment_auto_approve') . "', date_added = NOW()");

		$review_id = $this->db->getLastId();

		if ($this->config->get('config_review_mail')) {
			$this->admin_language->load('mail/review');
      
      $this->load->model('catalog/information');
			$item_info = $this->model_catalog_information->getInformation($information_id);   //admin lang?
      
			$subject = sprintf($this->admin_language->get('text_subject'), $this->config->get('config_name'));

			$message  = $this->admin_language->get('text_waiting') . "\n";
			$message .= sprintf($this->admin_language->get('text_item'), $this->db->escape(strip_tags($item_info['title']))) . "\n";
			$message .= sprintf($this->admin_language->get('text_reviewer'), $this->db->escape(strip_tags($data['name']))) . "\n";
			$message .= $this->admin_language->get('text_review') . "\n";
			$message .= $this->db->escape(strip_tags($data['text'])) . "\n\n";

			$mail = new Mail($this->config->get('config_mail'));
			$mail->setTo($this->config->get('config_email'));      
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($this->config->get('config_name'));
			$mail->setSubject($subject);
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();

			// Send to additional alert emails
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		$this->event->trigger('post.review.add', $review_id);
	}

	public function getReviewsByInformationId($information_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}
    
		$query = $this->db->query("SELECT r.review_id, r.author, r.rating, r.text, i.information_id, id.title, i.image, r.date_added FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX ."information i ON (r.information_id = i.information_id) LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND i.status = '1' AND r.status = '1' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalReviewsByInformationId($information_id) {
  
    $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "information i ON (r.information_id = i.information_id) LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND i.status = '1' AND r.status = '1' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}