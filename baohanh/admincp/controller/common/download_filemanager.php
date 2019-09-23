<?php
class ControllerCommonDownloadFileManager extends Controller {
	public function index() {
		$this->load->language('common/download_filemanager');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = rtrim(str_replace(array('../', '..\\', '..', '*'), '', $this->request->get['filter_name']), '/');
		} else {
			$filter_name = null;
		}

		// Make sure we have the correct directory
		if (isset($this->request->get['directory'])) {
			$directory = rtrim(DIR_DOWNLOAD . str_replace(array('../', '..\\', '..'), '', $this->request->get['directory']), '/');
		} else {
			$directory = substr(DIR_DOWNLOAD, 0, -1);
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['images'] = array();

		$this->load->model('tool/image');

		// Get directories
		$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

		if (!$directories) {
			$directories = array();
		}

		// Get files
		$files = glob($directory . '/' . $filter_name . '*.*', GLOB_BRACE);
    
    $pics = array(
			'.jpg',
			'.jpeg',
			'.png',
			'.gif',
      '.JPG',
			'.JPEG',
			'.PNG',
			'.GIF'
		);
    
    $known = array (
      '.aac',
      '.ai',
      '.aiff',
      '.avi',
      '.bmp',
      '.c',
      '.cpp',
      '.css',
      '.dat',
      '.dmg',
      '.doc',
      '.docx',
      '.dotx',
      '.dwg',
      '.dxf',
      '.eps',
      '.exe',
      '.flv',
      '.gif',
      '.h',
      '.hpp',
      '.html',
      '.ics',
      '.iso',
      '.java',
      '.jpg',
      '.key',
      '.mid',
      '.mp3',
      '.mp4',
      '.mpg',
      '.odf',
      '.ods',
      '.odt',
      '.otp',
      '.ots',
      '.ott',
      '.pdf',
      '.php',
      '.png',
      '.ppt',
      '.psd',
      '.py',
      '.qt',
      '.rar',
      '.rb',
      '.rtf',
      '.sql',
      '.tga',
      '.tgz',
      '.tiff',
      '.txt',
      '.wav',
      '.xls',
      '.xlsx',
      '.xml',
      '.yml',
      '.zip',
	  '.pdf'
	  
    );

		if (!$files) {
			$files = array();
		}

		// Merge directories and files
		$files = array_merge($directories, $files);

		// Get total number of files and directories
		$file_total = count($files);

		// Split the array based on current page number and max number of items per page of 10
		$files = array_splice($files, ($page - 1) * 16, 16);

		foreach ($files as $file) {
			$name = str_split(basename($file), 14);

			if (is_dir($file)) {
				$url = '';

				if (isset($this->request->get['target'])) {
					$url .= '&target=' . $this->request->get['target'];
				}

				if (isset($this->request->get['thumb'])) {
					$url .= '&thumb=' . $this->request->get['thumb'];
				}

				$data['images'][] = array(
					'thumb' => '',
					'name'  => implode(' ', $name),
					'type'  => 'directory',
					'path'  => utf8_substr($file, utf8_strlen(DIR_DOWNLOAD)),
					'href'  => $this->url->link('common/download_filemanager', 'token=' . $this->session->data['token'] . '&directory=' . urlencode(utf8_substr($file, utf8_strlen(DIR_DOWNLOAD))) . $url, 'SSL')
				);
			} elseif (is_file($file)) {
				// Find which protocol to use to pass the full image link back
				if ($this->request->server['HTTPS']) {
					$server = HTTPS_CATALOG;
				} else {
					$server = HTTP_CATALOG;
				}

        //Thumb creation
        
        
			$ext = strrchr($file, '.');
      $extthumb = '_blank.png';
      if (in_array(strtolower($ext), $known)) $extthumb = substr($ext, 1).'.png';
			  
        if (in_array(strtolower($ext), $pics)) {
          $data['images'][] = array(
  					'thumb' => $this->resize(utf8_substr($file, utf8_strlen(DIR_DOWNLOAD)), 100, 100),
  					'name'  => implode(' ', $name),
  					'type'  => 'image',
  					'path'  => utf8_substr($file, utf8_strlen(DIR_DOWNLOAD)),
  					'href'  => $server . 'download/' . utf8_substr($file, utf8_strlen(DIR_DOWNLOAD))
  				);
        } else {

  				$data['images'][] = array(
  					'thumb' => '/image/icons/48px/'.$extthumb,
  					'name'  => implode(' ', $name),
  					'type'  => 'image',
  					'path'  => utf8_substr($file, utf8_strlen(DIR_DOWNLOAD)),
  					'href'  => $server . 'download/' . utf8_substr($file, utf8_strlen(DIR_DOWNLOAD))
  				);
        }
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
    $data['text_rename'] = $this->language->get('text_rename');
    $data['text_new_name'] = $this->language->get('text_new_name');

		$data['entry_search'] = $this->language->get('entry_search');
		$data['entry_folder'] = $this->language->get('entry_folder');

		$data['button_parent'] = $this->language->get('button_parent');
		$data['button_refresh'] = $this->language->get('button_refresh');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_folder'] = $this->language->get('button_folder');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_search'] = $this->language->get('button_search');
    $data['button_edit'] = $this->language->get('button_edit');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['directory'])) {
			$data['directory'] = urlencode($this->request->get['directory']);
		} else {
			$data['directory'] = '';
		}

		if (isset($this->request->get['filter_name'])) {
			$data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$data['filter_name'] = '';
		}

		// Return the target ID for the file manager to set the value
		if (isset($this->request->get['target'])) {
			$data['target'] = $this->request->get['target'];
		} else {
			$data['target'] = '';
		}

		// Return the thumbnail for the file manager to show a thumbnail
		if (isset($this->request->get['thumb'])) {
			$data['thumb'] = $this->request->get['thumb'];
		} else {
			$data['thumb'] = '';
		}

		// Parent
		$url = '';

		if (isset($this->request->get['directory'])) {
			$pos = strrpos($this->request->get['directory'], '/');

			if ($pos) {
				$url .= '&directory=' . urlencode(substr($this->request->get['directory'], 0, $pos));
			}
		}

		if (isset($this->request->get['target'])) {
			$url .= '&target=' . $this->request->get['target'];
		}

		if (isset($this->request->get['thumb'])) {
			$url .= '&thumb=' . $this->request->get['thumb'];
		}

		$data['parent'] = $this->url->link('common/download_filemanager', 'token=' . $this->session->data['token'] . $url, 'SSL');

		// Refresh
		$url = '';

		if (isset($this->request->get['directory'])) {
			$url .= '&directory=' . urlencode($this->request->get['directory']);
		}

		if (isset($this->request->get['target'])) {
			$url .= '&target=' . $this->request->get['target'];
		}

		if (isset($this->request->get['thumb'])) {
			$url .= '&thumb=' . $this->request->get['thumb'];
		}

		$data['refresh'] = $this->url->link('common/download_filemanager', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['directory'])) {
			$url .= '&directory=' . urlencode(html_entity_decode($this->request->get['directory'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['target'])) {
			$url .= '&target=' . $this->request->get['target'];
		}

		if (isset($this->request->get['thumb'])) {
			$url .= '&thumb=' . $this->request->get['thumb'];
		}

		$pagination = new Pagination();
		$pagination->total = $file_total;
		$pagination->page = $page;
		$pagination->limit = 16;
		$pagination->url = $this->url->link('common/download_filemanager', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$this->response->setOutput($this->load->view('common/download_filemanager.tpl', $data));
	}

	public function upload() {
		$this->load->language('common/download_filemanager');

		$json = array();

		// Check user has permission
		if (!$this->user->hasPermission('modify', 'common/download_filemanager')) {
			$json['error'] = $this->language->get('error_permission');
		}

		// Make sure we have the correct directory
		if (isset($this->request->get['directory'])) {
			$directory = rtrim(DIR_DOWNLOAD . str_replace(array('../', '..\\', '..'), '', $this->request->get['directory']), '/');
		} else {
			$directory = DIR_DOWNLOAD;
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = $this->language->get('error_directory');
		}

		if (!$json) {
			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array(
					'jpg',
					'jpeg',
					'gif',
					'png'
				);
        /*
				if (!in_array(utf8_strtolower(utf8_substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}
        */
				// Allowed file mime types
				$allowed = array(
					'image/jpeg',
					'image/pjpeg',
					'image/png',
					'image/x-png',
					'image/gif'
				);
        /*
				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}
        */
				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Return any upload error
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}
		}

		if (!$json) {
			move_uploaded_file($this->request->files['file']['tmp_name'], $directory . '/' . $filename);

			$json['success'] = $this->language->get('text_uploaded');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function folder() {
		$this->load->language('common/download_filemanager');

		$json = array();

		// Check user has permission
		if (!$this->user->hasPermission('modify', 'common/download_filemanager')) {
			$json['error'] = $this->language->get('error_permission');
		}

		// Make sure we have the correct directory
		if (isset($this->request->get['directory'])) {
			$directory = rtrim(DIR_DOWNLOAD . str_replace(array('../', '..\\', '..'), '', $this->request->get['directory']), '/');
		} else {
			$directory = DIR_DOWNLOAD;
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = $this->language->get('error_directory');
		}

		if (!$json) {
			// Sanitize the folder name
			$folder = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($this->request->post['folder'], ENT_QUOTES, 'UTF-8')));

			// Validate the filename length
			if ((utf8_strlen($folder) < 3) || (utf8_strlen($folder) > 128)) {
				$json['error'] = $this->language->get('error_folder');
			}

			// Check if directory already exists or not
			if (is_dir($directory . '/' . $folder)) {
				$json['error'] = $this->language->get('error_exists');
			}
		}

		if (!$json) {
			mkdir($directory . '/' . $folder, 0777);

			$json['success'] = $this->language->get('text_directory');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function delete() {
		$this->load->language('common/download_filemanager');

		$json = array();

		// Check user has permission
		if (!$this->user->hasPermission('modify', 'common/download_filemanager')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['path'])) {
			$paths = $this->request->post['path'];
		} else {
			$paths = array();
		}

		// Loop through each path to run validations
		foreach ($paths as $path) {
			$path = rtrim(DIR_DOWNLOAD . str_replace(array('../', '..\\', '..'), '', $path), '/');

			// Check path exsists
			if ($path == DIR_DOWNLOAD) {
				$json['error'] = $this->language->get('error_delete');

				break;
			}
		}

		if (!$json) {
			// Loop through each path
			foreach ($paths as $path) {
				$path = rtrim(DIR_DOWNLOAD . str_replace(array('../', '..\\', '..'), '', $path), '/');

				// If path is just a file delete it
				if (is_file($path)) {
					unlink($path);

				// If path is a directory beging deleting each file and sub folder
				} elseif (is_dir($path)) {
					$files = array();

					// Make path into an array
					$path = array($path . '*');

					// While the path array is still populated keep looping through
					while (count($path) != 0) {
						$next = array_shift($path);

						foreach (glob($next) as $file) {
							// If directory add to path array
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}

							// Add the file to the files to be deleted array
							$files[] = $file;
						}
					}

					// Reverse sort the file array
					rsort($files);

					foreach ($files as $file) {
						// If file just delete
						if (is_file($file)) {
							unlink($file);

						// If directory use the remove directory function
						} elseif (is_dir($file)) {
							rmdir($file);
						}
					}
				}
			}

			$json['success'] = $this->language->get('text_delete');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
  
  public function rename() {
		$this->load->language('common/download_filemanager');

		$json = array();
    
    // Check user has permission
		if (!$this->user->hasPermission('modify', 'common/download_filemanager')) {
			$json['error'] = $this->language->get('error_permission');
		}

		// Make sure we have the correct directory
		if (isset($this->request->get['directory'])) {
			$directory = rtrim(DIR_DOWNLOAD . str_replace(array('../', '..\\', '..'), '', $this->request->get['directory']), '/');
		} else {
			$directory = DIR_DOWNLOAD;
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = $this->language->get('error_directory');
		}

    
		if (!$json && isset($this->request->post['filename'])  && isset($this->request->post['old'])) {
      
			// Sanitize the folder name
			$filename = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($this->request->post['filename'], ENT_QUOTES, 'UTF-8')));
      
      $old=$this->request->post['old']; 

			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) {
				$json['error'] = $this->language->get('error_folder_or_file');
			}

			// Check if directory already exists or not
			if (is_dir($directory . '/' . $filename)) {
				$json['error'] = $this->language->get('error_exists');
			}
		}

		if (!$json) {
      
      rename($directory . '/' . $old, $directory . '/' . $filename);

			$json['success'] = $this->language->get('text_rename_succ');
		}
    
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
  
  private function resize($filename, $width, $height) {
		if (!is_file(DIR_DOWNLOAD . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/download/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_DOWNLOAD . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_DOWNLOAD . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_DOWNLOAD . $old_image);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_DOWNLOAD . $old_image, DIR_IMAGE . $new_image);
			}
		}

		if ($this->request->server['HTTPS']) {
			return HTTPS_CATALOG . 'image/' . $new_image;
		} else {
			return HTTP_CATALOG . 'image/' . $new_image;
		}
	}
  
}