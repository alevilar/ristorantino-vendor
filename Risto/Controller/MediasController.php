<?php

App::uses('AppController', 'Controller');


class MediasController extends AppController {

	public $name = 'Configs';

    public $uses = array('Risto.Media');

    public function view ($id) {
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


    public function thumb ($id) {
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
