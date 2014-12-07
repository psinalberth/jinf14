<?php
class TipoAtividade extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'TipoAtividade';
	public $useTable		=    'tipo_atividade';
	public $label			=	'Tipo de Atividade';
  
	
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
	
	public $validate 		= 	array(
		'nome' => array('rule' => 'notEmpty','message' => 'Este Campo não pode ser Vazio!'),
		'id' => array('rule' => 'notEmpty','message' => 'Este Campo não pode ser Vazio!'),
	);
	
	
	public function beforeSave(){
	}
	
}	
?>