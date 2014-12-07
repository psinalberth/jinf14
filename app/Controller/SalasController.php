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
class SalasController extends AppController{
    
    public $name = "Salas";
    
    public $uses = array();

    public function add(){
        //$this->checkAccess( $this->name, __FUNCTION__ );
       pr($_GET);die;
    }
    
}

?>
