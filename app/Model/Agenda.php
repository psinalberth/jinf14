<?php

class Agenda extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name  = 'Agenda';

	public $useTable =    'agenda';

	public $label = 'Agenda';

	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	
	
	public $belongsTo = array( 
		'Atividade' => array( 
			'className' => 'Atividade', 
			'foreignKey' => 'atividade_cod_ativ' 
		),
		'Edicao' => array( 
			'className' => 'Edicao', 
			'foreignKey' => 'cod_edicao' 
		),
		'Sala' => array( 
			'className' => 'Sala', 
			'foreignKey' => 'sala_id' 
		),
		
	);	
	
	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate = array(
	);
	
	/*----------------------------------------
	 * Methods
	 ----------------------------------------*/
	


	
	
}