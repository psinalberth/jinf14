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
		
		$departamento = $this->Departamento->findById($id);
		
		$this->checkResult($departamento, 'Departamento');
		$this->set("departamento", $departamento);
	}
	
	public function add() {
		
		if ($this->request->isPost()) {
			
			$this->Departamento->create($this->request->data);
			
			if ($this->Departamento->validates()) {
				
				if ($this->Departamento->save(null, false)) {
					
					$this->setMessage('saveSuccess', 'Departamento');
					$this->redirect(array('controller' => $this->name, 'action' => 'view', $this->Departamento->id));
					
				} else
				
					$this->setMessage('saveError', 'Departamento');
					
			} else {
				
				$this->setMessage('validateError');
			}
		}
	}
	
	public function edit($id = null) {
		
		$this->Departamento->id = $id;

		if ($this->request->isGet()) {
			
			$this->Departamento->contain();
			$this->data = $this->Departamento->findById($id);
				
		} else {
			
			if ($this->Departamento->validates()) {
			
				if ($this->Departamento->save($this->request->data)) {
			
					$this->setMessage('saveSuccess', 'Departamento');
					$this->redirect(array('controller' => $this->name, 'action' => 'view', $this->Departamento->id));
			
				} else
			
					$this->setMessage('saveError', 'Departamento');
					
			} else {
			
				$this->setMessage('validateError');
			}
		}
	}
	
	public function delete($id = null) {
		
		if($this->Departamento->delete($id))
			
			$this->setMessage('deleteSuccess', 'Departamento');
		
		else
			$this->setMessage('saveError', 'Departamento');
			
		$this->redirect(array('controller' => $this->name, 'action' => 'index'));
	}
}