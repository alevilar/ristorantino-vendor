<?php
class Query extends PqueryAppModel {

	var $validate = array(
		'name' => array('notBlank'),
		'query' => array('notBlank'),
	);

	
	/**
	 * Me lista todas las categorias que existen en la Queries
	 * si se le pasa como parametro un "*" me trae todas
	 *  
	 * @param string $filtro
	 * @return array $categorias find(all)
	 */
	function listarCategorias($filtro = '*'){

		$conditions[] = array('categoria <>'=>"");

		if($filtro != '*'){
			$conditions[] = array("categoria LIKE" => "%".$filtro."%");
		}
		$this->recursive = -1;

		$categorias =  $this->find('all', array(
					'group' => 'categoria',
					'conditions'=> $conditions,
					'fields' => array('categoria')
		));

		return $categorias;
	}
	
	
	
	function beforeSave(){
		parent::beforeSave();
		
		//----------------------------------------------------
		// Con esto hago que si se puso un punto y coma en la consulta, lo elimine.
		// Por convencion estamos guardando las queries sin punto y coma.
		if(!empty($this->data['Query']['query'])){
			$query = trim($this->data['Query']['query']);
			
			$ult_char = substr($query,strlen($query),1);
			if($ult_char == ';'){
				$this->data['Query']['query'] = substr($query,0,strlen($query)-1);
			}
		}
		return true;
	}
}
?>