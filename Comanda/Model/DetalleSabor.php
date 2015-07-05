<?php
App::uses('ComandaAppModel', 'Comanda.Model');

class DetalleSabor extends ComandaAppModel {

	public $name = 'DetalleSabor';
	public $validate = array(
		'detalle_comanda_id' => array('numeric'),
		'sabor_id' => array('numeric')
	);


	public $actsAs = array(
		'Utils.SoftDelete', 
		'Containable',
		);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'DetalleComanda' => array('className' => 'Comanda.DetalleComanda',
								'foreignKey' => 'detalle_comanda_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Sabor' => array('className' => 'Product.Sabor',
								'foreignKey' => 'sabor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
        
        
    public function afterSave(  $created, $options = array() ) 
	{
		$ds = $this->find('first', array(
				'contain'=> array(
					'DetalleComanda.Comanda'
					),
				'conditions' => array(
					'DetalleSabor.id' => $this->id,
				)
			)
		);
		if ( !empty($ds['DetalleComanda']['Comanda']['mesa_id']) ) {
			$this->DetalleComanda->Comanda->Mesa->id = $ds['DetalleComanda']['Comanda']['mesa_id'];
			return $this->DetalleComanda->Comanda->Mesa->saveField('modified', date('Y-m-d H:i:s'));
		}
		return true;
	}

}
