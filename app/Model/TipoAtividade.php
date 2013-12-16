<?php

class TipoAtividade extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'TipoAtividade';

	public $useTable		=    'tipo_atividade';

	public $label			=	'Usuário';

  
	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	
	public $hasMany = array( 
		'Atividade' => array( 
			'className' => 'Atividade', 
			'foreignKey' => 'tipo_atividade_id' ) 
	);



	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate 		= 	array();

	
	
	public function beforeSave(){

	}
	
}	

?>