<?php

class TipoAtividadesController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "TipoAtividades";
	
	public $setMenu	= "Tipo de Atividade";

	public $label = 'Tipo de Atividade';
	
	public $submenu	= array( 'index', 'add');

	public $uses = array('Atividade', 'TipoAtividade','Agenda', 'Profile', 'Tipo de Atividades');

	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function index(){
		$this->checkAccess( $this->name, __FUNCTION__ );
		$this->paginate[ 'fields' ] = array( 'TipoAtividade.id', 'TipoAtividade.nome');
		$this->paginate[ 'order' ] = "TipoAtividade.id";
		$this->set( "tipoAtividades", $this->paginate( "TipoAtividade" ) );
	}
	
	public function view( $id = null ){
		
		$this->checkAccess( $this->name, __FUNCTION__ );

		$this->TipoAtividade->contain();
		$tipoAtividades = $this->TipoAtividade->find( 'first', array('conditions' => array('TipoAtividade.id' => $id)));

		$this->set( "tipoAtividades", $tipoAtividades );
		
		
	}
	
	public function add(){

		
		$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->request->isPost() ){
			$this->TipoAtividade->contain();
			if(!$this->TipoAtividade->find( 'list', array('conditions' => array('TipoAtividade.nome' => $this->request->data('TipoAtividade.nome'))))){
				$this->TipoAtividade->create( $this->request->data );
			}
			if( $this->TipoAtividade->validates() ){
				
				if( $this->TipoAtividade->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'TipoAtividade' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $this->TipoAtividade->getLastInsertId()));
					
				} else
					$this->setMessage( 'saveError', 'TipoAtividade' );
				
			} else
				$this->setMessage( 'validateError' );
		}
	}
	
	public function edit( $id = null ){

		$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->Profile->isAdmin( $id ) ){
			
			$this->Session->setFlash( "Você não pode <strong>editar</strong> o Tipo de Atividade <strong>Administrador</strong>.", "default", array( 'class' => 'error' ) );
			$this->redirect( array( 'controller' => $this->name, 'action' => 'view', 1 ) );
		}
		
		$this->TipoAtividade->id = $id;
		if( $this->request->is('get') ){
			$this->request->data = $this->TipoAtividade->read();
		} else {
			if( $this->TipoAtividade->validates() ){

				if( !$this->TipoAtividade->find( 'list', array('conditions' => array('TipoAtividade.nome' => $this->request->data('TipoAtividade.nome'))))){
					if($this->TipoAtividade->save( $this->request->data )){
						$this->setMessage( 'saveSuccess', 'TipoAtividade' );
						$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
					}
				} else					
					$this->setMessage( 'saveError', 'TipoAtividade' );
				
			} else				
				$this->setMessage( 'validateError' );
		}
		
		$this->set( "tipo_atividades", $this->TipoAtividade->find('list', array('fields'=> array('id','nome'))));
	}
	
	public function delete( $id = null ){
			
		$this->checkAccess( $this->name, __FUNCTION__ );
	
		if( $this->TipoAtividade->delete( $id) )
			$this->setMessage( 'deleteSuccess', 'TipoAtividade' );
		else
			$this->setMessage( 'deteleError', 'TipoAtividade' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );		
	}

	
}

?>