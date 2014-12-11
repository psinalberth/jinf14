<?php

class EdicoesController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "Edicoes";
	
	public $setMenu	= "Edicoes";

	public $label = 'Perfil de Usuário';
	
	public $submenu	= array( 'index', 'add' );

	public $uses = array('Edicao');
	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function index(){

		$this->checkAccess( $this->name, __FUNCTION__ );
		$this->paginate[ 'fields' ] = array( 'id', 'nome', 'data_ini','data_fim' );
		$this->paginate[ 'order' ] = "Edicao.created DESC";
		$this->set( "edicoes", $this->paginate( "Edicao" ) );
	}
	
	public function view( $id = null ){
		
		$this->checkAccess( $this->name, __FUNCTION__ );

		$user = $this->Edicao->findById( $id );

		$this->set( "edicoes", $user );
		
		
	}
	
	public function add(){
		
		$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->request->isPost() ){
			
			$this->Edicao->create( $this->request->data );
			
			if( $this->Edicao->validates() ){
				
				if( $this->Edicao->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Edicao' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $this->Edicao->getLastInsertId() ) );
					
				} else
					$this->setMessage( 'saveError', 'Profile' );
				
			} else
				$this->setMessage( 'validateError' );
		}
		
		//$this->set( "areas", $this->Profile->Area->lists() );
	}
	
	public function edit( $id = null ){

		$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->Profile->isAdmin( $id ) ){
			
			$this->Session->setFlash( "Você não pode <strong>editar</strong> o Perfil <strong>Administrador</strong>.", "default", array( 'class' => 'error' ) );
			$this->redirect( array( 'controller' => $this->name, 'action' => 'view', 1 ) );
		}
		
		if( !$this->request->isPut() ){
			
			$this->Edicao->contain( );
			$this->data = $this->Edicao->findById( $id );
			
		} else {

			$this->Edicao->create( $this->request->data);

			if( $this->Edicao->validates() ){

				if( $this->Edicao->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Edicao' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
					
				} else					
					$this->setMessage( 'saveError', 'Profile' );
				
			} else				
				$this->setMessage( 'validateError' );
		}
		
		//$this->set( "edicoes", $this->Edicao->lists() );
	}
	
	public function delete( $id = null ){
			
		$this->checkAccess( $this->name, __FUNCTION__ );
	
		if( $this->Profile->isAdmin( $id ) ){
			
			$this->Session->setFlash( "Você não pode <strong>excluir</strong> o Perfil <strong>Administrador</strong>.", "default", array( 'class' => 'error' ) );
			$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
		}
		
		if( $id == $this->Auth->user( "profile_id" ) ){
			
			$this->Session->setFlash( "Você não pode <strong>excluir</strong> seu próprio <strong>Perfil</strong>.", "default", array( 'class' => 'error' ) );
			$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
		}
		
		if( $this->Edicao->delete( $id ) )
			$this->setMessage( 'deleteSuccess', 'Edicao' );
		else
			$this->setMessage( 'deteleError', 'Edicao' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );		
	}

	
}

?>