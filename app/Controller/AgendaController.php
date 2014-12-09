<?php

class AgendaController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "Agenda";
	
	public $setMenu	= "Agenda";

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
				'Agenda.data', 'Agenda.horario_ini', 'Agenda.horario_fim',
				'Agenda.horario_fim', 'Atividade.nome_atividade', 'TipoAtividade.nome',
				'Sala.descricao', 
				'Edicao.nome', 'Edicao.data_ini', 'Edicao.data_fim'
			);
			$this->paginate[ 'order' ] = "Agenda.horario_ini";
			$this->paginate[ 'joins' ] = array(
		    	array('table' => 'salas',
			        'alias' => 'Sala',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Sala.id = Agenda.sala_id',
			        )
			    ),
			    array('table' => 'edicao',
			        'alias' => 'Edicao',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Edicao.id = Agenda.edicao_id',
			            'Edicao.ano' => $this->request->data['Agenda']['ano']

			        )
			    ),
			    array('table' => 'Atividade',
			        'alias' => 'Atividade',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Atividade.id = Agenda.atividade_id',
			        )
			    ),
			    array('table' => 'tipo_atividade',
			        'alias' => 'TipoAtividade',
			        'type' => 'INNER',
			        'conditions' => array(
			            'TipoAtividade.id = Atividade.tipo_atividade_id',
			        )
			    ),		
			);
				

			$this->set( "programacao", $this->paginate( "Agenda" ) );
        }else{
            
        $ano_atual = $this->Edicao->find('first', array('order' => 'Edicao.ano DESC', 'contain' => array()));

	$this->checkAccess( $this->name, __FUNCTION__ );
			$this->paginate[ 'fields' ] = array( 
				'Agenda.data', 'Agenda.horario_ini', 'Agenda.horario_fim',
				'Agenda.horario_fim', 'Atividade.nome_atividade', 'TipoAtividade.nome',
				'Sala.descricao', 
				'Edicao.nome', 'Edicao.data_ini', 'Edicao.data_fim'
			);
			$this->paginate[ 'order' ] = array('Agenda.horario_ini');
			$this->paginate[ 'joins' ] = array(
			    array('table' => 'Atividade',
			        'alias' => 'Atividade',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Atividade.id = Agenda.atividade_id',
			        )
			    ),
			    array('table' => 'tipo_atividade',
			        'alias' => 'TipoAtividade',
			        'type' => 'INNER',
			        'conditions' => array(
			            'TipoAtividade.id = Atividade.tipo_atividade_id',
			        )
			    ),
			    array('table' => 'salas',
			        'alias' => 'Sala',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Sala.id = sala.id',
			        )
			    ),
			    array('table' => 'edicao',
			        'alias' => 'Edicao',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Edicao.id = Agenda.edicao_id',
			            'Edicao.ano' => $ano_atual['Edicao']['ano']

			        )
			    )		
			);
			$paginacao = $this->paginate( "Agenda" );
			if (empty($paginacao)){
				$this->set( "programacao",  $ano_atual['Edicao']['ano'] );				
			}else
				$this->set( "programacao", $paginacao );

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
		$options = array('PM', 'AM');
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

		$this->set('data', $data);
		$this->set( "atividades", $this->Atividade->find('list', array('fields'=> array('id','nome_atividade'))));
		$this->set( "salas", $this->Sala->find('list', array('fields'=> array('id','descricao'))));
		$this->set( "edicoes", $this->Edicao->find('list',array('fields'=> array('id','ano') )));

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
	
		if( $this->Agenda->delete( $id) )
			$this->setMessage( 'deleteSuccess', 'Profile' );
		else
			$this->setMessage( 'deteleError', 'Atividade' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );		
	}

	
}

?>