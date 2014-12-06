<?php

/**
 * @author inalberth
 */
class Departamento extends AppModel {
	
	public $name = 'Departamento';
	public $useTable = 'departamentos';
	public $label = 'Usuário';
	public $primaryKey = 'id';
	
	public $hasMany = array('Sala');
	
	public $validate = array(
			
		'name' => array('rule' => 'notEmpty', 'message' => 'Preencha o nome do Departamento')
	);
}
?>