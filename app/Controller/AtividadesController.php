<?php

class AtividadesController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "Atividades";
	
	public $setMenu	= "Atividades";

	public $label = 'Atividades';
	
	public $submenu	= array( 'index', 'add');

	public $uses = array('Atividade', 'TipoAtividade', 'Agenda', 'Profile', 'Inscricao');

	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function index(){
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
			$this->Atividade->contain();
			if(!$this->Atividade->find( 'list', array('conditions' => array('Atividade.nome_atividade' => $this->request->data('Atividade.nome_atividade'))))){
				$this->Atividade->create( $this->request->data );
			}
			if( $this->Atividade->validates() ){
				
				if( $this->Atividade->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Atividade' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $this->Atividade->getLastInsertId()));
					
				} else
					$this->setMessage( 'saveError', 'Atividade' ); 
				
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
		$this->Atividade->id = $id;
		if( $this->request->is('get') ){
			$this->request->data = $this->Atividade->read();			
		} else {
			if( $this->Atividade->validates() ){
				//if(!$this->Atividade->find( 'list', array('conditions' => array('Atividade.nome_atividade' => $this->request->data('Atividade.nome_atividade'))))){
					if( $this->Atividade->save( $this->request->data ) ){
						
						$this->setMessage( 'saveSuccess', 'Atividade' );
						$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
					}	
				/*}*/ else					
					$this->setMessage( 'saveError', 'Atividade' );
			} else				
				$this->setMessage( 'validateError' );
		}
		
		$this->set( "tipo_atividades", $this->TipoAtividade->find('list', array('fields'=> array('id','nome'))));
	}
	
	public function delete( $id = null ){
			
		$this->checkAccess( $this->name, __FUNCTION__ );
	
		if( $this->Atividade->delete( $id) )
			$this->setMessage( 'deleteSuccess', 'Atividade' );
		else
			$this->setMessage( 'deteleError', 'Atividade' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );		
	}

	public function listapresenca($id = null){
	
	//	$this->checkAccess( $this->name, __FUNCTION__ );

		$agenda = $this->Agenda->find('first', array('conditions' => array('agenda.Atividade_id' => $id, 'Edicao.ano' => $this->Session->read('ultima_edicao_ano'))));
	
		$agenda1 = $agenda['Agenda']['id'];

		$pessoas = $this->Inscricao->query("Select *from inscricao join users where users.id = inscricao.user_id and inscricao.programacao_id = '{$agenda1}'");


		//pr($pessoas);
		//die();

		$this->set("pessoas",$pessoas);
	}
	
		public function validapresenca( $id = null){
		
	//	$this->checkAccess( $this->name, __FUNCTION__ );
		
		$this->Inscricao->contain();
		$Inscricao = $this->Inscricao->findById( $id );
		

		if( $Inscricao['Inscricao']['presenca'] )
			{$Inscricao['Inscricao']['presenca'] = 0;
			$valor = 0;}
		else{
			$Inscricao['Inscricao']['presenca'] = 1;
			$valor = 1;
		}

		$this->Inscricao->id = $this->Inscricao->field('id', array('id' => $id));
		if ($this->Inscricao->id) {
    		$this->Inscricao->saveField('presenca', $valor);
		}
		$this->redirect( array( 'controller' => "Colaboradores", 'action' => "indexlist" ) );
	}


}

?>