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
    
    public $helpers = array('Fpdf');


    public $setMenu = "Inscricoes";
    
    public $label = 'Inscrições';
	
    public $submenu = array( 'index', 'add', 'listaPresenca' );

    
    function beforeFilter() { 
        $this->Auth->allow('add'); 
     
        //$this->Security->validatePost = false;
        //$this->Security->csrfCheck = false;
    }
    
    public function index(){
        
       $this->paginate['contain'] = array('User', 'Agenda');
       
       $conditions = array();
       
       //Se o usuário não pesquisar por edição ele pega sempre a última
       if (empty($this->request->data['Agenda']['edicao_id'])){
           $conditions['Agenda.edicao_id'] = $this->Session->read('ultima_edicao_id');
       }
       
       //Se o usuário fazer um pesquisa o postConditions é chamad para montar a busca
       if (!empty($this->request->data)){
            $conditions = $this->postConditions($this->request->data, array('name' => 'LIKE', 'email' => 'LIKE'));
       }
       
       $this->paginate['conditions'] = $conditions;
       
       $this->paginate['fields'] = array('User.*');
       $this->paginate['group'] = array('Inscricao.user_id');
       
       $this->set('inscricoes', $this->paginate('Inscricao'));
       $this->set('options', $this->Edicao->find('list', array('fields' => array('ano'))));
    }
    
    public function view($id = null){
        
        $contain = array(
            'User',
            'Agenda' => array(
                'Atividade' => array(
                    'fields' => array('id', 'nome_atividade')
                )
            )
        );
        $inscrito = $this->Inscricao->find('all', array('conditions' => array('User.id' => $id), 'contain' => $contain));

        $this->set('inscrito', $inscrito);
    }
    
    function add(){
        $this->layout = 'inscricao';
        
        if( $this->request->isPost() ){

               $this->request->data['User']['profile_id'] = 2;
                $this->User->create( $this->request->data );
             
                if( $this->User->validates() ){
                        
                        if( $this->User->save() ){
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
        
        $this->set('options_checkbox_atividades', $this->getOptionsAtividadePorEdicao($this->Session->read('ultima_edicao_id')));
        $this->set('cursos', $this->Curso->find('list', array('fields' => array('name'))));
    }
    
    function addLogado(){
        $this->layout = 'inscricao';
        
        if( $this->request->isPost() ){

               $this->request->data['User']['profile_id'] = 2;
                $this->User->create( $this->request->data );
             
                if( $this->User->validates() ){
                        
                        if( $this->User->save() ){
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

        $this->set('options_checkbox_atividades',$this->getOptionsAtividadePorEdicao($this->Session->read('ultima_edicao_id')));
        $this->set('cursos', $this->Curso->find('list', array('fields' => array('name'))));
    }
    
    public function edit($id){
        
        if( $this->request->isPost() ){
            
                if( $this->User->validates() ){
                        $this->User->id = $id;
                        if( $this->User->save($this->request->data) ){
                                $this->Session->setFlash( 'Inscrição editada com sucesso!', "default", array( 'class' => 'success' ) );
                                $this->redirect( array('action' => 'view', $id ) );

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
 
        $this->set('options_checkbox_atividades',  $this->getOptionsAtividadePorEdicao($this->Session->read('ultima_edicao_id')));
        $this->set('cursos', $this->Curso->find('list', array('fields' => array('name'))));

    }
    
    public function delete($id) {
        
        //Código caso eu não queira que esse método seja executado por requisição GET
//        if ($this->request->is('get')) {
//            throw new MethodNotAllowedException();
//        }

        if ($this->User->delete($id)) {
            $this->Session->setFlash( 'Inscrição excluída com sucesso!', "default", array( 'class' => 'success' ) );
            return $this->redirect(array('action' => 'index'));
        }else{
             $this->setMessage( 'saveError', 'Profile' );
        }
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
    
    function listaPresenca() { 
        
        $this->set('atividades', $this->Atividade->find('list', array('fields' => array('nome_atividade'))));
        $this->set('edicoes', $this->Edicao->find('list',  array('fields' => array('ano'))));
        // $this->set('options', $this->Edicao->find('list', array('fields' => array('ano'))));
        //pr($this->TipoAtividade->find('all'));
    } 
    
    function imprimirListaPresenca(){
        $this->layout = 'pdf';
        
        if (!empty($this->request->data)){

            $conditions = $this->builderConditions(array(
                    'Agenda.atividade_id' => array('number', $this->request->data['Agenda']['atividade_id']),
                    'Agenda.edicao_id' => array('number', $this->request->data['Agenda']['edicao_id'])
            ));

            $inscricoes_atividade = $this->Inscricao->find('all', array('conditions' => $conditions));
            $atividade = $this->Atividade->find('first', array('conditions' => array('Atividade.id' => $this->request->data['Agenda']['atividade_id'])));
            
           
            if (empty($inscricoes_atividade)){
                $this->Session->setFlash( 'Nenhum resultado encontrado!', "default", array( 'class' => 'error' ) );
                return $this->redirect(array('action' => 'listaPresenca'));                
            }
            $this->set('atividade', $atividade);
            $this->set('inscricoes_atividade', $inscricoes_atividade);
        
        }
        
    }
            
    function getOptionsAtividadePorEdicao($edicao_id){
        
        $conditions = array();
        
        if (!empty($edicao_id)){
            
        }
        
        $agendas = $this->Agenda->find('all', array(
            'conditions' => array('Edicao.id' => $edicao_id),
        ));
        
        
        $tipo_atividades = $this->TipoAtividade->find('list', array('fields' => array('nome')));
        $atividades = array();
        foreach ($agendas as $agenda){
           if (array_key_exists($agenda['Atividade']['tipo_atividade_id'], $tipo_atividades)){
               $agenda['Atividade']['programacao_id'] = $agenda['Agenda']['id'];
               $agenda['Atividade']['data'] = $agenda['Agenda']['data'];
               $agenda['Atividade']['horario_ini'] = $agenda['Agenda']['horario_ini'];
               $agenda['Atividade']['horario_fim'] = $agenda['Agenda']['horario_fim'];
               $agenda['Atividade']['vagas_restantes'] = $agenda['Agenda']['vagas_restantes'];
               $atividades[$tipo_atividades[$agenda['Atividade']['tipo_atividade_id']]][] = $agenda['Atividade'];
               //$atividades['Agenda'] = $agenda['Agenda'];
           }
        }
        
        $options = array();
        foreach ($atividades as $tipo_atividade => $atividade){
            foreach ($atividade as $ativ){
                $data = CakeTime::format($ativ['data'], '%d/%m/%Y');
                $hora_inicio = CakeTime::format($ativ['horario_ini'], '%H:%M');
                $hora_fim = CakeTime::format($ativ['horario_fim'], '%H:%M');
                $vagas = $ativ['vagas_restantes'];
                
                $txt = "{$ativ['nome_atividade']} ( {$data} das {$hora_inicio} às {$hora_fim} - Vagas Restantes: {$vagas})";
                $options[$tipo_atividade][$ativ['programacao_id']] = $txt ;
            }
        }
        
        return $options;
    }
}


