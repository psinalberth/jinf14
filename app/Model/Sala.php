<?php

class Sala extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name = 'Sala';
	public $useTable = 'salas';
	public $label = 'Sala';
	//public $primaryKey = 'id';

	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/

	public $belongsTo = array(
			'Departamento' => array(
					'className' => 'Departamento',
					'foreignKey' => 'departamento_id'
			)
	);
	
	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate 		= 	array();
	


	/*----------------------------------------
	 * Methods
	 ----------------------------------------*/
	

	/*----------------------------------------
	 * Callbacks
	 ----------------------------------------*/

	public function beforeValidate( $options = array() ){

	}
	
	public function beforeSave(){
	
	}
}	

?>
