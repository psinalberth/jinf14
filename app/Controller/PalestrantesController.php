<?php

class PalestrantesController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "Palestrantes";
	
	public $setMenu	= "Palestrantes";

	public $label = 'Agenda';

	public $submenu	= array( 'index', 'add' );

	public $uses = array('Atividade', 'TipoAtividade','Agenda', 'Profile', 'Edicao','Sala');

	public $layout = 'layout2';

	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function index(){


		if ($this->request->isPost()){
			$this->checkAccess( $this->name, __FUNCTION__ );
			$this->paginate[ 'fields' ] = array( 
				'Palestrante.id', 'Palestrante.descricao','User.nome', 'User.id',
			);
			$this->paginate[ 'order' ] = "Agenda.horario_ini";
			$this->paginate[ 'joins' ] = array(
			    array('table' => 'users',
			        'alias' => 'User',
			        'type' => 'INNER',
			        'conditions' => array(
			            'User.id = Palestrante.id',
			        )
			    ),		
			);

			$this->set( "palestrantes", $this->paginate( "Palestrante" ) );
        }


		//pr($this->paginate( "Agenda" ));

		
	}
	
	public function view( $id = null ){
		
		$this->checkAccess( $this->name, __FUNCTION__ );

		$this->Atividade->contain();
		$atividade = $this->Atividade->find( 'first', array('conditions' => array('Atividade.id' => $id)));

		$this->set( "atividade", $atividade );
		
		
	}
	
	public function add($data = null){
		
		$this->checkAccess( $this->name, __FUNCTION__ );
		if( $this->request->isPost() ){
			
			$this->request->data['Agenda']['horario_ini'] = str_replace(array(' PM', ' AM'), ':00', $this->request->data['Agenda']['horario_ini']);
			$this->request->data['Agenda']['horario_fim'] = str_replace(array(' PM', ' AM'), ':00', $this->request->data['Agenda']['horario_fim']);

	
			$this->Agenda->create( $this->request->data );
			
			if( $this->Agenda->validates() ){
				
				if( $this->Agenda->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Agenda' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'index'));
					
				} else
					$this->setMessage( 'saveError', 'Agenda' );
				
			} else
				$this->setMessage( 'validateError' );
		}

		$this->set( "users", $this->Edicao->find('list',array('fields'=> array('id','nome') )));

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