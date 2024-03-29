<?php
class ModelToolImage extends Model {

  public function realname($filename) {
    if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $filename;
		} else {
			return $this->config->get('config_url') . 'image/' . $filename;
		}
  }

	public function resize($filename, $width, $height) {
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}
	}
  
	public function resizeTo($filename, $width, $height, $resizeOption = 'default' , $crop_height = 0)
	{
    
    if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}
    
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    $old_image = $filename;
    
    list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);
    
    switch(strtolower($resizeOption))
		{
			case 'exact':
				$resizeWidth = $width;
				$resizeHeight = $height;
			break;

			case 'maxwidth':
				$resizeWidth  = $width;
				$resizeHeight = $this->resizeHeightByWidth($width,$width_orig,$height_orig);
			break;

			case 'maxheight':
				$resizeWidth  = $this->resizeWidthByHeight($height,$width_orig,$height_orig);
				$resizeHeight = $height;
			break;

			default:
				if($width_orig > $width || $height_orig > $height)
				{
					if ( $width_orig > $height_orig ) {
				    	 $resizeHeight = $this->resizeHeightByWidth($width,$width_orig,$height_orig);
			  			 $resizeWidth  = $width;
					} else if( $width_orig < $height_orig ) {
						$resizeWidth  = $this->resizeWidthByHeight($height,$width_orig,$height_orig);
						$resizeHeight = $height;
					}  else {
						$resizeWidth = $width;
						$resizeHeight = $height;	
					}
				} else {
		            $resizeWidth = $width_orig;
		            $resizeHeight = $height_orig;
		        }
			break;
		}
    if ($crop_height && $crop_height < $resizeHeight) {
		  $new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $resizeWidth . 'x_crop_' .$crop_height. '.' . $extension;
    } else {
      $new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $resizeWidth . 'x' . $resizeHeight . '.' . $extension;
    }

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

    if ($width_orig != $width || $height_orig != $height) {
        $image = new Image(DIR_IMAGE . $old_image);
				$image->resize2($resizeWidth, $resizeHeight);
        if ($crop_height && $crop_height < $resizeHeight) {
          $image->crop(0,(int)($resizeHeight/2)-(int)($crop_height/2),$resizeWidth,(int)($resizeHeight/2)+(int)($crop_height/2));
        } 
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}
		
	}

	private function resizeHeightByWidth($width,$width_orig,$height_orig)
	{
		return floor(($height_orig/$width_orig)*$width);
	}

	private function resizeWidthByHeight($height,$width_orig,$height_orig)
	{
		return floor(($width_orig/$height_orig)*$height);
	}

  
}