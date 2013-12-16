<?php

class AtividadesController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "Atividades";
	
	public $setMenu	= "Atividades";

	public $label = 'Atividades';
	
	public $submenu	= array( 'index', 'add' );

	public $uses = array('Atividade', 'TipoAtividade','Agenda', 'Profile');

	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function index(){
		//pr($this->Atividade->find('all'));
		$this->checkAccess( $this->name, __FUNCTION__ );
		$this->paginate[ 'fields' ] = array( 'Atividade.nome_atividade', 'Atividade.descricao', 'Atividade.duracao', 'Atividade.vagas','Atividade.id', 'TipoAtividade.nome');
		$this->paginate[ 'order' ] = "Atividade.id";
		$this->paginate[ 'joins' ] = array(
		    array('table' => 'tipo_atividade',
		        'alias' => 'TipoAtividade',
		        'type' => 'INNER',
		        'conditions' => array(
		            'TipoAtividade.id = Atividade.tipo_atividade_id',
		        )
		    )			
		);

		$this->set( "atividades", $this->paginate( "Atividade" ) );
	}
	
	public function view( $id = null ){
		
		$this->checkAccess( $this->name, __FUNCTION__ );

		$this->Atividade->contain();
		$atividade = $this->Atividade->find( 'first', array('conditions' => array('Atividade.id' => $id)));

		$this->set( "atividade", $atividade );
		
		
	}
	
	public function add(){

		
		$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->request->isPost() ){
			
			$this->Atividade->create( $this->request->data );
			
			if( $this->Atividade->validates() ){
				
				if( $this->Atividade->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Edicao' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $this->Atividade->getLastInsertId()));
					
				} else
					$this->setMessage( 'saveError', 'Profile' );
				
			} else
				$this->setMessage( 'validateError' );
		}

		
		$this->set( "tipo_atividades", $this->TipoAtividade->find('list', array('fields'=> array('id','nome'))));
	}
	
	public function edit( $id = null ){

		$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->Profile->isAdmin( $id ) ){
			
			$this->Session->setFlash( "Você não pode <strong>editar</strong> a Atividade <strong>Administrador</strong>.", "default", array( 'class' => 'error' ) );
			$this->redirect( array( 'controller' => $this->name, 'action' => 'view', 1 ) );
		}
		
		if( !$this->request->isPut() ){
			
			$this->Atividade->contain( );
			$this->data = $this->Atividade->findById( $id );
			
		} else {

			$this->Atividade->create( $this->request->data);

			if( $this->Atividade->validates() ){

				if( $this->Atividade->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Edicao' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
					
				} else					
					$this->setMessage( 'saveError', 'Profile' );
				
			} else				
				$this->setMessage( 'validateError' );
		}
		
		$this->set( "tipo_atividades", $this->TipoAtividade->find('list', array('fields'=> array('id','nome'))));
	}
	
	public function delete( $id = null ){
			
		$this->checkAccess( $this->name, __FUNCTION__ );
	
		if( $this->Atividade->delete( $id) )
			$this->setMessage( 'deleteSuccess', 'Profile' );
		else
			$this->setMessage( 'deteleError', 'Atividade' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );		
	}

	
}

?>