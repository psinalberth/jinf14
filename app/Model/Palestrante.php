<?php

class Palestrante extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'Palestrante';

	public $useTable		=    'atividade';

	public $label			=	'Usuário';

	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	public $hasOne¶ = array( 
		'User' => array( 
			'className' => 'User', 
			'foreignKey' => 'user_id' 
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