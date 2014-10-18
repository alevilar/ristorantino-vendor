<?php
App::uses('ProductAppController', 'Product.Controller');


class TagsController extends ProductAppController {
    public $paginate = array(
        'order' => array('Tag.created' => 'asc'),
        // 'paramType' => 'querystring',
    );


    public $scaffold;

    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->Tag->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->Tag->recursive = 0;
        $tag = $this->Paginator->paginate('Tag');
        $this->set('tag',$tag);
    }

}