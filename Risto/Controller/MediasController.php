<?php

App::uses('AppController', 'Controller');


class MediasController extends AppController {

	public $name = 'Configs';

    public $uses = array('Risto.Media');

    public function view ($id) {
        $media = $this->Media->read(null, $id);

        if ( strpos($media['Media']['type'], 'image/' ) !== false ) {
            $body = $media['Media']['file'];
            $type = $media['Media']['type'];
        } else {
            // si no son imagenes no mostrar, solo retornar un icono generico
            $body = file_get_contents( IMAGES.DS.'generic_file_512.png');
            $type = 'image/png';
        }

        $this->response->body( $body );
        $this->response->type($type);


        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }


    public function download ($id) {
        $media = $this->Media->read(null, $id);

        $body = $media['Media']['file'];
        $type = $media['Media']['type'];

        $this->response->body( $body );
        $this->response->type($type);


        //Optionally force file download
        $this->response->download($media['Media']['name']);

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }


    public function thumb ($id) {
        debug($id);
        $media = $this->Media->read(null, $id);
        $this->response->body($media['Media']['file']);
        $this->response->type($media['Media']['type']);

        // Set multiple headers
        $this->response->header(array(
            'Content-Disposition' => 'inline',
            'filename' => $media['Media']['name'],
        ));

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }
	
}
