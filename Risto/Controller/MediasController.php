<?php

App::uses('AppController', 'Controller');


class MediasController extends AppController {

	public $name = 'Configs';

    public $uses = array('Risto.Media');

    public function view ($id) {
        $this->Media->recursive = -1;
        $media = $this->Media->read(null, $id);

        $body = $media['Media']['file'];
        $type = $media['Media']['type'];

        $this->response->body( $body );
        $this->response->type( $type );

        $this->response->header( 'Content-disposition', "filename=" . $media['Media']['name'] );
        
        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }


    public function download ($id) {
        $this->Media->recursive = -1;
        $media = $this->Media->read(null, $id);

        $body = $media['Media']['file'];
        $type = $media['Media']['type'];

        $this->response->body( $body );
        $this->response->type( $type );

        $this->response->header( 'Content-disposition', "filename=" . $media['Media']['name'] );

        //Optionally force file download
        $this->response->download($media['Media']['name']);

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }


    /**
    *
    *   Muestra un thumbnain y se pueden enviar los anchos y los altos para generar un thumbail
    *
    **/
    public function thumb ($id, $width = 150, $height = null) {
        $this->Media->recursive = -1;
        $media = $this->Media->read(null, $id);

        if ( $media['Media']['type'] == "image/pdf") {
            // pdf thumb
            $im = new imagick();
            $im->readImageBlob($media['Media']['file']);

            $num_pages = $im->getNumberImages();
            if ( $num_pages > 0) {
                $im->setIteratorIndex(0);
            }
        } elseif ( strpos($media['Media']['type'], 'image/' ) !== false ) {
            $type = $media['Media']['type'];
            $im = new imagick();
            $im->readImageBlob($media['Media']['file']);
            $im->scaleImage($width, $height);
        } else {
            // si no son imagenes no mostrar, solo retornar un icono generico
            $file_generic_path = App::pluginPath('Risto') . DS . 'webroot' . DS . 'img' . DS . 'generic_file_doc.png';
            $genImg = file_get_contents( $file_generic_path );
            $im->readImageBlob( $genImg );
            $im->scaleImage($width, $height);            
        }

        $im->setImageFormat('jpg');
        $body = $im->getImageBlob();
        $type = 'image/jpg';

        $this->response->header( 'Content-disposition', "filename=" . $media['Media']['name'] );

        $this->response->body( $body );
        $this->response->type($type);

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }
	
}
