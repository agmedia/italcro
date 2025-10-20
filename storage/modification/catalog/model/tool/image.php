<?php

			//HUNTBEE WEBP
    		require DIR_SYSTEM.'library/vendor/huntbee-webp/autoload.php';
            use WebPConvert\WebPConvert;
			//HUNTBEE WEBP
			
class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {
		if (!is_file(DIR_IMAGE . $filename) || substr(str_replace('\\', '/', realpath(DIR_IMAGE . $filename)), 0, strlen(DIR_IMAGE)) != str_replace('\\', '/', DIR_IMAGE)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$image_old = $filename;
		$image_new = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height . '.' . $extension;


			//HUNTBEE WEBP
    		$webp_file 		= utf8_substr($image_new, 0, utf8_strrpos($image_new, "."));
    		
    		$webp_file		= str_replace('cache/','webp/',$webp_file);
    		
    		$webp_file 		= $webp_file.'.webp';
    		if (file_exists(DIR_IMAGE .$webp_file) and (isset($_SERVER['HTTP_ACCEPT'])) and (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false)) {
    			$image_new = $webp_file;
    		}
			//HUNTBEE WEBP
			
		if (!is_file(DIR_IMAGE . $image_new) || (filemtime(DIR_IMAGE . $image_old) > filemtime(DIR_IMAGE . $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_IMAGE . $image_old);
				 
			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				return DIR_IMAGE . $image_old;
			}
						
			$path = '';

			$directories = explode('/', dirname($image_new));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $image_old);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $image_new);

			if (in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG))) {
				error_reporting(0);
				$webp_source = 'image/'.$image_new;
				$webp_source_without_extension 		= utf8_substr($webp_source, 0, utf8_strrpos($webp_source, "."));
				
				$webp_source_without_extension		= str_replace('/cache/','/webp/',$webp_source_without_extension);
				
				$webp_destination 	= $webp_source_without_extension.'.webp';
				$options = [];
				try {
					WebPConvert::convert($webp_source, $webp_destination, $options);
					$webp_image = $image_new.'.webp';
				}catch (Exception $e){
					$this->log->write('Extension - Huntbee WebP Compression (Auto): Issue while processing (image) path '.$webp_source.'. Issue: '.$e->getMessage());
				}
			}
			
			} else {
				copy(DIR_IMAGE . $image_old, DIR_IMAGE . $image_new);

			if (in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG))) {
				error_reporting(0);
				$webp_source = 'image/'.$image_new;
				$webp_source_without_extension 		= utf8_substr($webp_source, 0, utf8_strrpos($webp_source, "."));
				
				$webp_source_without_extension		= str_replace('/cache/','/webp/',$webp_source_without_extension);
						
				$webp_destination 	= $webp_source_without_extension.'.webp';
				$options = [];
				try {
					WebPConvert::convert($webp_source, $webp_destination, $options);
					$webp_image = $image_new.'.webp';
				}catch (Exception $e){
					$this->log->write('Extension - Huntbee WebP Compression (Auto): Issue while processing (image) path '.$webp_source.'. Issue: '.$e->getMessage());
				}
			}
			
			}
		}
		
		$image_new = str_replace(' ', '%20', $image_new);  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
		
		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $image_new;
		} else {
			return $this->config->get('config_url') . 'image/' . $image_new;
		}
	}
}
