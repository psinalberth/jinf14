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
App::uses('CakeTime', 'Utility');
class InscricoesController extends AppController{
    //put your code here
    public $name = 'Inscricoes';
    
    public $uses = array('Atividade', 'Agenda', 'TipoAtividade', 'Edicao', 'Curso', 'User', 'Inscricao');
    
    public $setMenu = "Inscricoes";
    
    public $label = 'Inscrições';
	
    public $submenu = array( 'index', 'add' );
    
    public $ultimaEdicao;
    
    function beforeFilter() { 
        $this->Auth->allow('add'); 
        
        
        
        $this->ultimaEdicao = $this->Edicao->find('first', array(
            'fields' => array('Edicao.ano'),
            'order' => 'ano DESC',
            'contain' => array()
        ));
        
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
    }
    
    public function index(){
        
    }
    
    function add(){
        $this->layout = 'inscricao';
        
        if( $this->request->isPost() ){

               $this->request->data['User']['profile_id'] = 3;
                $this->User->create( $this->request->data );
             
                if( $this->User->validates() ){
                        
                        if( $this->User->save() ){
                                pr($this->request->data); die;
                                $this->Session->setFlash( 'Inscrição realizado com sucesso!', "default", array( 'class' => 'success' ) );
                                $this->redirect( array( 'controller' => $this->name, 'action' => 'add' ) );

                        } else
                                $this->setMessage( 'saveError', 'Profile' );

                } else
                        if(!empty($this->User->validationErrors['horario_conflito'])){
                            $this->set('erro_horario_conflito', $this->User->validationErrors['horario_conflito'][0]);
                        }
                        if(!empty($this->User->validationErrors['vagas'])){
                            $this->set('erro_vagas', $this->User->validationErrors['vagas'][0]);
                        }
                        $this->setMessage( 'validateError' );
        }
		        
//        $error = false;
//        if ($this->data){
//           
//           $this->request->data['User']['profile_id'] = 3;
//           
//           $dataSource = $this->User->getDataSource();
//           $dataSource->begin();
//           $this->User->create( $this->request->data['User']);
//           if( $this->User->validates() ){
//               if ($this->User->save()){
//                   $user_id = $this->User->getInsertID(); 
//                  //echo $user_id; die;
//                   if(isset($user_id)){
//                       foreach ($this->request->data['Inscricao'] as $programacao_id => $Inscricoes){
//                           if ($Inscricoes == 1){
//                               $this->request->data['Inscricao']['programacao_id'] = $programacao_id;
//                               $this->request->data['Inscricao']['user_id'] = $user_id;
//                               $this->Inscricao->create($this->request->data['Inscricao']);
//                               
//                               if( $this->Inscricao->validates() ){
//                                   if (!$this->Inscricao->save()){
//                                       $dataSource->rollback();
//                                       $this->setMessage( 'saveError', 'Inscricao' );
//                                       $this->redirect(array('action' => 'add'));
//                                   }
//                               }else{  
//                                       $dataSource->rollback();
//                                       $this->setMessage( 'saveError', 'Inscricao' );
//                                       $this->redirect(array('action' => 'add'));
//                               }
//                           }
//                       }
//                   }else{
//                       $dataSource->rollback();
//                       $this->setMessage( 'saveError', 'Inscricao' );
//                       $this->redirect(array('action' => 'add'));                       
//                   }   
//               }else{
//                   $dataSource->rollback();
//                  $this->setMessage( 'saveError', 'Inscricao' );
//               }
//           }else{
//               $this->setMessage( 'validateError' );
//           }
//           
// 
//
//        
//           
//        }
        
        $fields = array(
            'Agenda.id', 'TipoAtividade.id', 'TipoAtividade.nome',
            'Atividade.id', 'Atividade.nome_atividade'
        );
        
        $joins = array(
            array('table' => 'tipo_atividade',
                'alias' => 'TipoAtividade',
                'type' => 'INNER',
                'conditions' => array(
                    'TipoAtividade.id = Atividade.id',
                )
            )
            
        );
        
        $agendas = $this->Agenda->find('all', array(
            'conditions' => array('Edicao.ano' => 2014),
        ));
        
        $tipo_atividades = $this->TipoAtividade->find('list', array('fields' => array('nome')));
        $atividades = array();
        foreach ($agendas as $agenda){
           if (array_key_exists($agenda['Atividade']['tipo_atividade_id'], $tipo_atividades)){
               $agenda['Atividade']['programacao_id'] = $agenda['Agenda']['id'];
               $agenda['Atividade']['data'] = $agenda['Agenda']['data'];
               $agenda['Atividade']['horario_ini'] = $agenda['Agenda']['horario_ini'];
               $agenda['Atividade']['horario_fim'] = $agenda['Agenda']['horario_fim'];
               $atividades[$tipo_atividades[$agenda['Atividade']['tipo_atividade_id']]][] = $agenda['Atividade'];
               //$atividades['Agenda'] = $agenda['Agenda'];
           }
        }
        
        $options_checkbox_atividades = array();
        foreach ($atividades as $tipo_atividade => $atividade){
            foreach ($atividade as $ativ){
                $data = CakeTime::format($ativ['data'], '%d/%m/%Y');
                $hora_inicio = CakeTime::format($ativ['horario_ini'], '%H:%M');
                $hora_fim = CakeTime::format($ativ['horario_fim'], '%H:%M');
                
                $txt = "{$ativ['nome_atividade']} ( {$data} das {$hora_inicio} às {$hora_fim} - Vagas Restantes: {$ativ['vagas']})";
                $options_checkbox_atividades[$tipo_atividade][$ativ['programacao_id']] = $txt ;
            }
        }
        
        $this->set('atividades',$atividades);
        $this->set('options_checkbox_atividades',$options_checkbox_atividades);
        $this->set('cursos', $this->Curso->find('list', array('fields' => array('name'))));
    }
    
    private function checaEdicao($atividades)
    {
        if (!empty ($atividades)){
            foreach ($atividades['Agenda'] as $key => $atividade){  
                if (empty($atividade['Edicao']['ano'])){
                   pr($atividades['Agenda'][$key]);
                   unset($atividades['Agenda'][$key]);
                   //pr($atividades);
                }
                
            }
        }
        
        return $atividades;
    }
}


