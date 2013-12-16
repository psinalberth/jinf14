<?php

class Sala extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'Sala';

	public $useTable		=    'salas';

	public $label			=	'Usuário';

	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	public $hasMany = array( 
		'Sala' => array( 
			'className' => 'Sala', 
			'foreignKey' => 'sala_id' 
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