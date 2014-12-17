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

            $this->checkAccess( $this->name, __FUNCTION__ );
            
            if (!empty($this->request->data)){
                $options = $this->postConditions($this->request->data);
            }else{
                $options['Edicao.ano'] = $this->Session->read('ultima_edicao_ano');
            }
            
            $this->paginate[ 'fields' ] = array( 
                    'Agenda.id','Agenda.data', 'Agenda.horario_ini', 'Agenda.horario_fim','Agenda.vagas_restantes',
                    'Agenda.horario_fim', 'Atividade.nome_atividade', 'TipoAtividade.nome',
                    'Sala.descricao', 
                    'Edicao.nome', 'Edicao.data_ini', 'Edicao.data_fim'
            );
            
            $this->paginate[ 'order' ] = array('Agenda.horario_ini');
            
            $this->paginate['conditions'] = $options;
            
            $this->paginate['group'] = 'Agenda.id';
            
            $this->paginate[ 'joins' ] = array(
                array('table' => 'atividade',
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
                        'Sala.id = Sala.id',
                    )
                ),
                array('table' => 'edicao',
                    'alias' => 'Edicao',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Edicao.id = Agenda.edicao_id'
                    )
                )		
            );
            
            $programacao = $this->paginate( "Agenda" );
            
            $edicao = $this->Edicao->find('first', array('conditions' => array('Edicao.id' => $this->Session->read('ultima_edicao_id'))));
            
            $begin = new DateTime( $edicao['Edicao']['data_ini']);
            $end = new DateTime( $edicao['Edicao']['data_fim'] );
            //$end = $end->modify( '+1 day' ); 

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);
            
            $dias_programacao = array();
  
            foreach($daterange as $date){
                foreach ($programacao as $key => $prog){
                    if (date('d',strtotime($prog['Agenda']['data'])) == $date->format("d")){   
                        $dias_programacao[$date->format("d/m/Y")][] = $prog;
                        unset($programacao[$key]);
                    }
                }
            }
            
            //pr($dias_programacao);
            $this->set( "programacao", $this->paginate( "Agenda" ) );
            $this->set('options', $this->Edicao->find('list', array('fields' => array('ano'))));
		
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
			
			$this->Agenda->contain( );
			$this->data = $this->Agenda->findById( $id );
			
		} else {

			$this->Agenda->create( $this->request->data);

			if( $this->Agenda->validates() ){

				if( $this->Agenda->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Agenda' );
					$this->redirect( array( 'action' => 'index') );
					
				} else					
					$this->setMessage( 'saveError', 'Agenda' );
				
			} else				
				$this->setMessage( 'validateError' );
		}
		
		$this->set( "atividades", $this->Atividade->find('list', array('fields'=> array('id','nome_atividade'))));
		$this->set( "salas", $this->Sala->find('list', array('fields'=> array('id','descricao'))));
		$this->set( "edicoes", $this->Edicao->find('list',array('fields'=> array('id','ano') )));
	}
	
	public function delete( $id = null ){
			
		$this->checkAccess( $this->name, __FUNCTION__ );
	
		if( $this->Agenda->delete( $id) ){
			$this->setMessage( 'deleteSuccess', 'Agenda' );
                        $this->redirect( array( 'action' => 'index') );
                }
		else
			$this->setMessage( 'deteleError', 'Agenda' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );		
	}

	
}

?>