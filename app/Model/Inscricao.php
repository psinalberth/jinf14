<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inscricao
 *
 * @author Márcio Vennan
 */
class Inscricao extends AppModel{
    //put your code here
    public $name = 'Inscricao';
    
    public $useTable = 'inscricao';
    
    public $label = 'Inscrição';
    
    public $belongsTo = array( 
            'User' => array( 
                    'className' => 'User', 
                    'foreignKey' => 'user_id' 
            ),
            'Agenda' => array( 
                    'className' => 'Agenda', 
                    'foreignKey' => 'programacao_id' 
            )
    );
    
    public $validate = array(
        'programacao_id' 	=> array(
                'rule'		=> 'notEmpty',
                'message'	=> 'Preencha Nome'
        )
   );  
    
   public function beforeValidate($data){
      pr($data); die;
   }
}

