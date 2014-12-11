<?php

class Atividade extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'Atividade';

	public $useTable		=    'atividade';

	public $label			=	'Atividade';

	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	public $belongsTo = array( 
		'TipoAtividade' => array( 
			'className' => 'TipoAtividade', 
			'foreignKey' => 'tipo_atividade_id' 
		)
	);	
<<<<<<< HEAD
	/*public $hasMany = array( 
		'Agenda' => array( 
			'className' => 'Agenda', 
			'foreignKey' => 'atividade_cod_ativ' 
		)
	);	*/
=======
	//public $hasMany = array( 
	//	'Agenda' => array( 
	//		'className' => 'Agenda', 
	//		'foreignKey' => 'atividade_cod_ativ' 
	//	)
	//);	
>>>>>>> 99335e4481c780da3dcd8d0ed6b1939ecbb073d0
	
	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate 		= 	array(
		'nome_atividade' => array('rule' => 'notEmpty','message' => 'Este Campo não pode ser Vazio!'),
		'tipo_atividade_id' => array('rule' => 'notEmpty','message' => 'Este Campo não pode ser Vazio!'),
		'duracao' => array('notEmpty' => array('rule' => 'notEmpty','message' => 'Este Campo não pode ser Vazio!'), 'numeric'=> array('rule' =>'numeric', 'message' => 'Somente números')),
		'vagas' => array('notEmpty' => array('rule' => 'notEmpty','message' => 'Este Campo não pode ser Vazio!'), 'numeric'=> array('rule' =>'numeric', 'message' => 'Somente números'))

	);

	
	



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