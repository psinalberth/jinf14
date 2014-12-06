<?php

/**
 * @author inalberth
 */
class DepartamentosController extends AppController {
	
	public $name = "Departamentos";
	
	public $uses = array('Departamento');
	
	public function index() {
		
		//$this->checkAccess($this->name, __FUNCTION__);
		$this->paginate['fields'] = array('id', 'name');
		$this->paginate['order'] = "Departamento.id ASC";
		$this->set("departamentos", $this->paginate("Departamento"));
	}
	
	public function view($id = null) {
		
	}
	
	public function add() {
		
	}
	
	public function edit($id = null) {
		
	}
	
	public function delete($id = null) {
		
	}
}