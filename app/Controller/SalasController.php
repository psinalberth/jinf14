<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalasController
 *
 * @author Márcio Vennan
 */
class SalasController extends AppController {
    
    public $name = "Salas";
    public $uses = array('Sala', 'Departamento');
    
    public function index() {
    	
    	$this->paginate[ 'fields' ] = array('Sala.id', 'Sala.descricao', 'Sala.localidade', 'Departamento.name');
    	$this->paginate[ 'order' ] = "Sala.id";
    	$this->paginate[ 'joins' ] = array(
    			array('table' => 'departamentos',
    					'alias' => 'Departamento',
    					'type' => 'INNER',
    					'conditions' => array(
    							'Departamento.id = Sala.departamento_id',
    					)
    			)
    	);
    	
    	$this->set("salas", $this->paginate("Sala"));
    }
    
    public function view($id = null) {
    	
    	$this->Sala->contain();
    	$sala = $this->Sala->find( 'first', array('conditions' => array('Sala.id' => $id)));
    	$departamento = $this->Departamento->find('first', array(
    			'conditions' => array('Departamento.id' => $sala['Sala']['departamento_id'])));
    	
		$this->set(compact("sala","departamento"));
    }

    public function add(){
        //$this->checkAccess( $this->name, __FUNCTION__ );
        
    	if ($this->request->isPost()) {
    			
    		$this->Sala->create($this->request->data);
    			
    		if ($this->Sala->validates()) {
    	
    			if ($this->Sala->save(null, false)) {
    					
    				$this->setMessage('saveSuccess', 'Sala');
    				$this->redirect(array('controller' => $this->name, 'action' => 'view', $this->Sala->id));
    					
    			} else
    	
    				$this->setMessage('saveError', 'Sala');
    				
    		} else {
    	
    			$this->setMessage('validateError');
    		}
    	}
    	
    	$this->set("departamento", $this->Departamento->find('list', array('fields'=> array('id','name'))));
    }
    
    public function edit($id = null) {
    	
    	$this->Sala->id = $id;
    	
    	if ($this->request->isGet()) {
    			
    		$this->Sala->contain();
    		$this->data = $this->Sala->findById($id);
    	
    	} else {
    			
    		if ($this->Sala->validates()) {
    				
    			if ($this->Sala->save($this->request->data)) {
    					
    				$this->setMessage('saveSuccess', 'Sala');
    				$this->redirect(array('controller' => $this->name, 'action' => 'view', $this->Sala->id));
    					
    			} else
    					
    				$this->setMessage('saveError', 'Sala');
    				
    		} else {
    				
    			$this->setMessage('validateError');
    		}
    	}
    	
    	$this->set("departamento", $this->Departamento->find('list', array('fields'=> array('id','name'))));
    }
    
    public function delete($id = null) {
    	
    	if($this->Sala->delete($id))
    			
    		$this->setMessage('deleteSuccess', 'Sala');
    	
    	else
    		$this->setMessage('saveError', 'Sala');
    		
    	$this->redirect(array('controller' => $this->name, 'action' => 'index'));
    }
    
}
?>
