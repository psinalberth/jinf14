<?php

class Agenda extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name  = 'Agenda';

	public $useTable =    'programacao';

	public $label = 'Agenda';

	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	
	
	public $belongsTo = array( 
		'Atividade' => array( 
			'className' => 'Atividade', 
			'foreignKey' => 'atividade_id' 
		),
		'Edicao' => array( 
			'className' => 'Edicao', 
			'foreignKey' => 'edicao_id' 
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