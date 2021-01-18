<?php
namespace LIB;

class upload {
	
	const IMAGE_PATH = 'products/';

	public static function check ($image) {

		$image_name = date("Y-m-d-H-i-s").rand (2,3).".png";
		$uploadfile = self::IMAGE_PATH . basename($image_name);	
		if($image['error']== UPLOAD_ERR_OK){
			// make sure file uploaded by upload process
			if(is_uploaded_file($image['tmp_name'])){
				// Check size
				if($image['size'] <= 1000000){
					// Check if image file is a actual image or fake image
					$check = getimagesize($image['tmp_name']);
					if($check !== false) {
						$upload= move_uploaded_file($image['tmp_name'],$uploadfile);
						if($upload){return $image_name;}
					}
				}
			}
		}		
		return false;
	}

}
?>
