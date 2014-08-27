<?php

App::uses('ProductAppController', 'Product.Controller');


class CategoriasController extends ProductAppController
{

    public $name = 'Categorias';
    public $helpers = array(
        'FileUpload.FileUpload',
        );

    //var $layout;
    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index()
    {
        $this->Categoria->recursive = 0;
        $this->set('imagenes', $this->Categoria->find('list', array('fields' => array('Categoria.id', 'Categoria.image_url'))));
        $this->set('categorias', $this->Categoria->generateTreeList(null, null, null, '-&nbsp;-&nbsp;-&nbsp;'));
    }

    /**
     * 
     * Reordena el arbol alfabeticamente y devuelve a la pagtalla index
     * 
     */
    function reordenar()
    {
        $this->Categoria->reorder(array('field' => 'Categoria.name', 'order' => 'ASC'));
        $this->redirect(array('action' => 'index'));
    }

    function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Categoria.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('categoria', $this->Categoria->read(null, $id));
    }

    function recover()
    {
        if ( $this->Categoria->recover() ) {
            $this->Session->setFlash('Recuperación correcta', 'flash_success');
        } else {
            $this->Session->setFlash('Error al querer arreglar la estructura', 'flash_error');
        }
        $this->redirect(array('action' => 'index'));
    }

    function verify()
    {
        $verificados = $this->Categoria->verify();
        if ( empty($verificados) ) {
            $this->Session->setFlash('Recuperación correcta', 'flash_success');
        } else {
            $cant = count($verificados);
            $this->Session->setFlash("Existen $cant de registros que no estan correctos. Pruebe con el link de \"recuperar\"", 'flash_error');
        }
        $this->redirect(array('action' => 'index'));
    }

    function edit($id = null)
    {

        if (!empty($this->request->data['Categoria']['newfile']['name'])) {
            $path = IMG_MENU;

            $name = Inflector::slug(strstr($this->request->data['Categoria']['newfile']['name'], '.', true));
            $ext = substr(strrchr($this->request->data['Categoria']['newfile']['name'], "."), 1);
            $nameFile = $name . ".$ext";

            if (file_exists($path . $nameFile)) {
                $i = 1;
                $nameFile = $name . "_$i.$ext";
                while (file_exists($path . $nameFile)) {
                    $i++;
                    $nameFile = $name . "_$i.$ext";
                }
            }

            $this->request->data['Categoria']['image_url'] = $name . ".$ext";

            move_uploaded_file($this->request->data['Categoria']['newfile']['tmp_name'], $path . $nameFile);
        }

        if (!empty($this->request->data)) {
            if (empty($id)) {
                $this->Categoria->create();
            }
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash(__('The Categoria has been saved'), 'flash_success');
//				$this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Categoria could not be saved. Please, try again.'), 'flash_error');
            }

            if (empty($id)) {
                $this->redirect(array('action'=>'index'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Categoria->read(null, $id);
        }
        $this->set('categorias', $this->Categoria->generateTreeList(null, null, null, '-- '));
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Categoria'), 'flash_error');
        }
        if ($this->Categoria->delete( $id )) {
            $this->Session->setFlash(__('Categoria deleted'), 'flash_success');
        }
        $this->redirect(array('action' => 'index'));
    }

    function listar()
    {
        $categorias = $this->Categoria->array_listado();
        $this->set('categorias', $categorias);
        $this->set('_serialize', array('categorias')); //json output
    }

}

?>