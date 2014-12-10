<?php

class Colaborador extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'Colaborador';

	public $useTable		=    'colaboradores';

	public $label			=	'Colaborador';

	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	

	public $belongsTo = array( 
		'User' => array( 
			'className' => 'User', 
			'foreignKey' => 'user_id' 
		),
		'Agenda' => array( 
			'className' => 'Agenda', 
			'foreignKey' => 'programacao_id' 
		)
	);	
	
	/*public $hasMany = array(
 	'User' => array( 
			'className' => 'User', 
			'foreignKey' => 'user_id' 
		),
	'Agenda' => array( 
			'className' => 'Agenda', 
			'foreignKey' => 'programacao_id' 
		)
 );*/
 


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