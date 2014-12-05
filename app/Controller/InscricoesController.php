<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscricoesController
 *
 * @author Márcio Vennan
 */
class InscricoesController extends AppController{
    //put your code here
    public $name = 'Inscricoes';
    
    public $uses = array('Atividade', 'Agenda', 'TipoAtividade', 'Edicao');
    
    function beforeFilter() { 
        $this->Auth->allow('add'); 
    }
    
    function add(){
        $this->layout = 'inscricao';

        $this->TipoAtividade->contain(
                array(
                    'Atividade' => array(
                        'Agenda' => array(
                            'fields' => array('id', 'cod_edicao'),
                            'Edicao' => array(
                                'fields' => array('cod_edicao', 'ano'),
                                'conditions' => array('Edicao.ano' => 2013)
                            )
                        )
                    )
                )
        );
        $tipo_atividades = $this->TipoAtividade->find('all', array(
            
        ));

        pr($tipo_atividades); 
        $this->set('tipo_atividades',$tipo_atividades);
    }
}


