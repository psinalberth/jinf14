<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CertificadosController
 *
 * @author marcio
 */
class CertificadosController extends AppController{
   
    public $name = 'Certificados';
    
    public $submenu = array( 'index');
    
    public $uses = array('ConfigCertificado', 'Edicao', 'Agenda', 'Inscricao');
    
    public $helpers = array('CertificadoPdf');



    public function index(){
        
       $this->paginate['contain'] = array('User', 'Agenda');
       $conditions = array();      
       
       if (empty($this->request->data['Agenda']['edicao_id']))
           unset($this->request->data['Agenda']['edicao_id']);
       
        $conditions = $this->postConditions($this->request->data, array('name' => 'LIKE', 'email' => 'LIKE'));
        
       if ($this->Auth->user('id') != 1)
           $conditions['User.id'] = $this->Auth->user('id');
  
       
       $this->paginate['conditions'] = $conditions;    
       $this->paginate['fields'] = array('User.*', 'Agenda.*');
       $this->paginate['group'] = array('Inscricao.user_id');
       
       //pr($this->paginate('Inscricao'));
       $this->set('inscricoes', $this->paginate('Inscricao'));
       $this->set('options', $this->Edicao->find('list', array('fields' => array('ano'))));
       
    }

    public function configuracao($id){
        
        //$this->checkAccess( $this->name, __FUNCTION__ );
       //
        $this->ConfigCertificado->id = $id;
        if( $this->request->is('get') ){
                $this->request->data = $this->ConfigCertificado->read();			
        } else {
                if( $this->ConfigCertificado->validates() ){
                                //Setando campos de upload
                                $this->ConfigCertificado->fields_upload = array('imagem_fundo', 'imagem_topo', 'imagem_assinatura_coord');
                                
                                $this->ConfigCertificado->path_upload = 'img' . DS . 'certificados';
                                
                        //if(!$this->ConfigCertificado->find( 'list', array('conditions' => array('ConfigCertificado.nome_atividade' => $this->request->data('ConfigCertificado.nome_atividade'))))){
                                if( $this->ConfigCertificado->save( $this->request->data ) ){
                                        $this->setMessage( 'saveSuccess', 'ConfigCertificado' );
                                        $this->redirect( array('action' => 'configuracao', $id ) );
                                }	
                        /*}*/ else					
                                $this->setMessage( 'saveError', 'ConfigCertificado' );
                } else				
                        $this->setMessage( 'validateError' );
        }
        
        $this->set('options', $this->Edicao->find('list', array('fields' => array('ano'))));
    }
    
    public function imprimir($edicao_id, $user_id){  
        $this->layout = 'pdf';
        $conditons = $this->postConditions($this->request->data);
        $certificado = array();
        
        if(is_numeric($user_id) && is_numeric($edicao_id)){
            $edicao = $this->Edicao->find('first', array('conditions' => array('Edicao.id' => $edicao_id)));
            $total_inscrito = $this->Inscricao->find('count', array('conditions' => array('User.id' => $user_id)));
            $total_presenca = $this->Inscricao->find('count', array('conditions' => array('User.id' => $user_id, 'Inscricao.presenca' => 1)));
            $porcenteagem_presenca = $total_presenca/$total_inscrito;
     
            if ($porcenteagem_presenca >= 0.50){
                $inscricao = $this->Inscricao->find('first', array('conditions' => array('User.id' => $user_id)));
                
                $certificado = $this->ConfigCertificado->find('first', array('conditions' => array('edicao_id' => $edicao_id)));
                $certificado['ConfigCertificado']['ano'] = $edicao['Edicao']['ano'];
                $certificado['ConfigCertificado']['participante'] = $inscricao['User']['name'];
            }else{
                $this->Session->setFlash( 'Participante não participou de 50% das atividades requeridas.', "default", array( 'class' => 'error' ) );
                $this->redirect( array('action' => 'index') );
            }
        }
       
        $this->set('certificado', $certificado);
    }
    
}
