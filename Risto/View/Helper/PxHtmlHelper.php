<?php

App::uses('Bs3HtmlHelper', 'Bs3Helpers.View/Helper');



class PxHtmlHelper extends Bs3HtmlHelper {
	

    public function mediaLink ( $media, $options = array() ) {
        if( is_numeric($media) ) {
            $id = $media;
        }
        if ( !empty( $media ) && !empty($media['id'] ) ) {
            $id = $media['id'];
        }
        
        if (empty($id)) return '';

        $img = $this->imageMedia( $media, $options );


        $route = array('plugin' => 'risto', 'controller'=>'medias', 'action'=>'view', $id );       
        $url = $this->url( $route );
        return $this->link($img, $url, array('escape'=>false, 'class'=>'px-media-link'));
    }


	public function imageMedia ( $media, $options = array() ) {        
        if( is_numeric($media) ) {
            $id = $media;
        }
        if ( !empty( $media['id'] ) && !empty($media['id'] ) ) {
            $id = $media['id'];
        }
        if (!empty($id)){
            $route = array('plugin' => 'risto', 'controller'=>'medias', 'action'=>'thumb', $id );
            if ( ( !empty($options['width']) && is_numeric($options['width']) ) || ( !empty($options['height'] ) && is_numeric($options['height']) ) ) {
                $route[] = (float) !empty($options['width']) ? $options['width'] : 0 ;
                $route[] = (float) !empty($options['height']) ? $options['height'] : 0;
            }
            $url = $this->url( $route );
    		return $this->image( $url , $options );	
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
            
}