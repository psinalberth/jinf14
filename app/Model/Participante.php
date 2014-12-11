<?php
 //autora: Bianca Maria
 //
class Participante extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name  = 'Participante';

	public $useTable = 'programacao';
        
        public $label = 'Usuario';
        
        private $bianca;
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	
        public $hasOne = array( 
		'User' => array( 
			'className' => 'User', 
			'foreignKey' => 'user_id' 
		)
	
);
	
	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate = array();
	
	/*----------------------------------------
	 * Methods
	 ----------------------------------------*/
	
        public function beforeValidate( $options = array() ){

	}
	
	public function beforeSave(){

		
	}
}
?>
