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
    
    public $uses = array('Salas', 'Departamentos');
    
    public function index() {
    	
    }
    
    public function view($id = null) {
    	
    }

    public function add(){
        //$this->checkAccess( $this->name, __FUNCTION__ );
       pr($_GET);die;
    }
    
    public function edit($id = null) {
    	
    }
    
    public function delete($id = null) {
    	
    }
    
}
?>
