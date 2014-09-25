<?php

App::uses('Bs3HtmlHelper', 'Bs3Helpers.View/Helper');



class PxHtmlHelper extends Bs3HtmlHelper {


	/**
	 * Other helpers used by FormHelper
	 *
	 * @var array
	 */
	public $helpers = array(
		'Html' => array(
            'className' => 'Bs3Helpers.Bs3Html'
            ),
		);



	public function imageMedia ( $media, $options = array() ) {
        if( is_numeric($media) ) {
            $id = $media;
        }
        if ( !empty( $media['id'] ) && !empty($media['id'] ) ) {
            $id = $media['id'];
        }
        if (!empty($id)){
			$url = $this->Html->url(array('plugin' => 'risto', 'controller'=>'medias', 'action'=>'view', $id ));
    		return $this->Html->image( $url , $options );	
    	}
	}

	public function imageData ( $media, $options = array() ) {
		$path = 'data:'. $media['type'] .';base64,'.base64_encode($media['file']);
		$options = array_diff_key($options, array('fullBase' => null, 'pathPrefix' => null));

		if (!isset($options['alt'])) {
			$options['alt'] = '';
		}

		$image = sprintf($this->_tags['image'], $path, $this->_parseAttributes($options, null, '', ' '));
	
		return $image;
	}


	 private function _generate_image_thumbnail($source_image_path, $thumbnail_image_path) {
                list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
                switch ($source_image_type) {
                    case IMAGETYPE_GIF:
                        $source_gd_image = imagecreatefromgif($source_image_path);
                        break;
                    case IMAGETYPE_JPEG:
                        $source_gd_image = imagecreatefromjpeg($source_image_path);
                        break;
                    case IMAGETYPE_PNG:
                        $source_gd_image = imagecreatefrompng($source_image_path);
                        break;
                    default:
                        return false;
                }
                if ($source_gd_image === false) {
                    return false;
                }
                $source_aspect_ratio = $source_image_width / $source_image_height;
                $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
                if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
                    $thumbnail_image_width = $source_image_width;
                    $thumbnail_image_height = $source_image_height;
                } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
                    $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
                    $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
                } else {
                    $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
                    $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
                }
                $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
                imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
                imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
                imagedestroy($source_gd_image);
                imagedestroy($thumbnail_gd_image);
                return true;
            }

            
}