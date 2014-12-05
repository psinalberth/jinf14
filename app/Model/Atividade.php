<?php

class Atividade extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'Atividade';

	public $useTable		=    'atividade';

	public $label			=	'Usuário';

	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	public $belongsTo = array( 
		'TipoAtividade' => array( 
			'className' => 'TipoAtividade', 
			'foreignKey' => 'tipo_atividade_id' 
		)
	);	
	public $hasMany = array( 
		'Agenda' => array( 
			'className' => 'Agenda', 
			'foreignKey' => 'atividade_cod_ativ' 
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