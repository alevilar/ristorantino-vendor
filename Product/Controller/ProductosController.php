<?php


App::uses('ProductAppController', 'Product.Controller');



class ProductosController extends ProductAppController {

	public $name = 'Productos';


    public function producto_first_time () {
        $this->elementMenu = false;
        $this->layout = 'Install.default';
        $this->index();
    }
        
	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Producto->parseCriteria( $this->Prg->parsedParams() );
		$this->Paginator->settings['conditions'] = $conds; 
        $this->Paginator->settings['limit'] = 50;
        $this->Paginator->settings['contain'] = array(
            'Categoria',
            'Printer',
            'ProductosPreciosFuturo',
            );

        $printers = $this->Producto->Printer->listarComanderas();
		$categorias = $this->Producto->Categoria->generateTreeList();
        $this->set(compact('categorias','printers'));
        $sinStocks = array(
            0 => 'Con Stock',
            1 => 'Sin Stock',
            );

        $productos = $this->Paginator->paginate();
        if ( empty($productos) ) {
            if( $this->Producto->find('count') == 0) {
                $msg_sin_productos = __("Deberá crear Productos. Le recomendamos comenzar con algunos, sólo para comenzar, luego podrá agregar el resto.");
                $this->set('msgSinProductos', $msg_sin_productos);
            } 
        }
		$this->set('productos', $productos);
        $this->set('sinStocks', $sinStocks);
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Producto.', true));
			$this->redirect(array('action'=>'index'));
		}
                $fields = array(
                    'DetalleComanda.producto_id',
                    'sum(DetalleComanda.cant_eliminada) as "cant_eliminada"',
                    'sum(DetalleComanda.cant - DetalleComanda.cant_eliminada) as "suma"', 
                    'DATE(DetalleComanda.created) as "date"');
                
                $this->set('consumiciones', $this->Producto->DetalleComanda->find('all', array(
                    'conditions' => array(
                        'DetalleComanda.producto_id' => $id,
                    ),
                    'contain' => array('DetalleSabor.Sabor'),
                    'fields' => $fields,
                    'group' => 'DetalleComanda.producto_id, DATE(DetalleComanda.created) HAVING sum(DetalleComanda.cant - DetalleComanda.cant_eliminada) > 0',
                    'order' => 'DetalleComanda.created DESC',                    
                )));
                
                $this->Producto->contain(array(
                   'Categoria', 'HistoricoPrecio' => array('order'=>'HistoricoPrecio.created DESC') , 'Printer', 'ProductosPreciosFuturo'
                ));
		$this->set('producto', $this->Producto->read(null, $id));
	}



	public function add() {
		if (!empty($this->request->data)) {
			$this->Producto->create();
			if ($this->Producto->save($this->request->data)) {
				$this->Session->setFlash(__('The Producto has been saved', true));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.', true));
			}
		}

        $referer = $this->referer();
		$printers = $this->Producto->Printer->listarComanderas();
        $tags = $this->Producto->Tag->find('list');
		$categorias = $this->Producto->Categoria->generateTreeList(null, null, null, '___');
		$this->set(compact('categorias','printers', 'tags', 'referer'));
        $this->render('form');
	}

	public function edit( $id = null ) {

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Producto', true));
			$this->redirect($this->referer());
		}

		if (!empty($this->request->data)) {
			if ($this->Producto->save($this->request->data)) {
                $this->Session->setFlash('El producto fue guardado correctamente');                
                $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.'), 'Risto.flash_error');
			}
		}


        $referer = $this->referer();
        $this->request->data = $this->Producto->read(null, $id);
		$printers = $this->Producto->Printer->listarComanderas();
		$categorias = $this->Producto->Categoria->generateTreeList(null, null, null, '___');
        $tags = $this->Producto->Tag->find('list');
		$this->set(compact('categorias','printers', 'tags', 'referer'));
        $this->render('form');
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Producto'), 'Risto.flash_error');			
		} else {
		  $this->Producto->delete($id);
        }
        $this->redirect($this->referer());
	}
	
	
	// public function buscarProductos(){
		
	// 	$this->render('index');
		
	// }


        public function actualizarPreciosFuturos(){
            $failed = false;
            $preciosFuturos = $this->Producto->ProductosPreciosFuturo->find('all');
            $productos = array();
            $pfs['ProductosPreciosFuturo.id'] = array();
            foreach ($preciosFuturos as $pf){
                $pfs['ProductosPreciosFuturo.id'][] = $pf['ProductosPreciosFuturo']['id'];
                $productos[] = array( 'Producto' => array(
                        'precio' => $pf['ProductosPreciosFuturo']['precio'],
                        'id' => $pf['ProductosPreciosFuturo']['producto_id']
                    ));
            }

            if ( $this->Producto->saveAll($productos)) {
                    if ( $this->Producto->ProductosPreciosFuturo->deleteAll($pfs) ) {
                        $this->Session->setFlash('Falló al querer eliminar los precios futuros', 'Risto.flash_error');
                    }

                    $this->Session->setFlash('Se han modificado TODOS los precios futuros de los productos');

            } else {
                $this->Session->setFlash('Fallo al aplicar los cambios', 'Risto.flash_error');
            }
            
            $this->redirect($this->referer());
        }
              
        
        
        public function update()
        {
        	$msg = 'sin cambios';
            // Configure::write('debug',0);
            $data = $this->request->data;
            $this->Producto->id = $data['product_id'];

            $dataField = $data['field'];
            $dataValue = formatearPrecio(trim(trim($data['value'])));
            $dataFinal = (!empty($data['text'])) ? $data['text'] : $dataValue;
            $pf = 'precio_futuro';
            
            if ( $dataField == 'precio_futuro') {
                //buscar a ver si existe previamente            
                $ppf['ProductosPreciosFuturo'] = array(
                        'producto_id' => $this->Producto->id,
                        'precio' => $dataValue,
                    );
                if ( $this->Producto->ProductosPreciosFuturo->save( $ppf ) )  {
                    $msg = $dataFinal;
                } else {
                    $msg = "error al guardar precio futuro";
                    $this->log($msg);
                }
            } else {
                if ($this->Producto->saveField($dataField, $dataValue)) {
                    $msg = $dataFinal;
                } else {             
                    $msg = "error al guardar campo: $dataField, valor: $dataValue";
                    $this->log($msg);
                    $this->log( json_encode($this->Producto->validationErrors) );
                }
            }
            $this->set('msg', $msg);
        }
      
}

