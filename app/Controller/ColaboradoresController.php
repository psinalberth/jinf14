<?php

class ColaboradoresController extends AppController {

	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/
	
	public $name	= "Colaboradores";
	
	public $setMenu = "Colaboradores";

	public $label	= "Colaboradores";
	
	public $submenu	= array( 'index', 'add' );

	public $uses = array('Colaborador','Agenda','User','Atividade','TipoAtividade','Edicao');

	

	/*----------------------------------------
	 * Callbacks
	 ----------------------------------------*/
	
	public function beforeFilter(){
		
		parent::beforeFilter();
		Security::setHash( "md5" );
	}
	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function index(){

		//$this->checkAccess( $this->name, __FUNCTION__ );
		$this->paginate[ 'fields' ] = array( 'Colaborador.id','Atividade.nome_atividade' ,'Users.name', 'agenda.id','Colaborador.funcao' );
		//$this->paginate[ 'order' ] = "Colaborador.created DESC";
		
		$this->paginate[ 'joins' ] = array(
		    	array('table' => 'Users',
			        'alias' => 'Users',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Users.id = Colaborador.user_id',
			        )
			    ),
			    array('table' => 'programacao',
			        'alias' => 'agenda',
			        'type' => 'INNER',
			        'conditions' => array(
			            'agenda.id = Colaborador.programacao_id', 
			            			        )
			    ),
			    array('table' => 'Atividade',
			        'alias' => 'Atividade',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Atividade.id = agenda.atividade_id',
			        )
			    )/*,
			    array('table' => 'edicao',
			        'alias' => 'Edicao',
			        'type' => 'INNER',
			        'conditions' => array(
			            'Edicao.id = agenda.id', 
			            			        )
			    )
			    	*/

			    );
		//pr($this->paginate( "Colaborador" ));
		//die();
		
		$this->set( "Colaboradores", $this->paginate( "Colaborador" ) );
	}
	
	public function view( $id = null ){
			
	//	$this->checkAccess( $this->name, __FUNCTION__ );

		$Colaborador = $this->Colaborador->findById($id);
		//pr($this->ultimaEdicao);
		//die();	
		$agenda = $this->Agenda->find('first', array('conditions' => array('agenda.id' => $Colaborador['Colaborador']['programacao_id'], 'Edicao.ano' => $this->ultimaEdicao)));
		
		$atividade = $this->Atividade->find('first',array('conditions' => array('Atividade.id' => $agenda['Agenda']['atividade_id'])));
		

		//pr(compact("Colaborador","agenda","atividade"));
		//die();
		$this->set( compact("Colaborador","agenda","atividade") );
		
		}
	
	
	public function add(){
		
	//	$this->checkAccess( $this->name, __FUNCTION__ );
		
		if( $this->request->isPost() ){
	
		//pr($this->request->data);
		//die();		
			$this->Colaborador->create( $this->request->data );
			
			if( $this->Colaborador->validates() ){
				
				if( $this->Colaborador->save( null, false ) ){
					
					$this->setMessage( 'saveSuccess', 'Colaborador' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $this->Colaborador->id ) );
					
				} else
					$this->setMessage( 'saveError', 'Colaborador' );
				
			} else
				$this->setMessage( 'validateError' );
		}
		


	
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
            'conditions' => array('Edicao.ano' => $this->ultimaEdicao),
        ));
        
        $tipo_atividades = $this->TipoAtividade->find('list', array('fields' => array('nome')));
        $atividades = array();
        foreach ($agendas as $agenda){
           if (array_key_exists($agenda['Atividade']['tipo_atividade_id'], $tipo_atividades)){
               $agenda['Atividade']['programacao_id'] = $agenda['Agenda']['id'];
               $atividades[$tipo_atividades[$agenda['Atividade']['tipo_atividade_id']]][] = $agenda['Atividade'];
               //$atividades['Agenda'] = $agenda['Agenda'];
           }
        }
        
        foreach ($atividades as $tipo_atividade => $atividade){
            foreach ($atividade as $ativ){
                 $options[$ativ['programacao_id']] = $ativ['nome_atividade'] ;
            }
        }
		
        //pr($options);
        //die();
		$this->set( "users",$this->User->find('list', array('fields'=> array('id','name')))); 
		//$this->set( "agenda",$this->Agenda->find('list', array('fields'=> array('id','atividade_cod_ativ'))));
		$this->set( "atividade",$options);

	}
	
	public function edit( $id = null ){
		
	//	$this->checkAccess( $this->name, __FUNCTION__ );
		$this->Colaborador->id = $id;

		if( $this->request->isGet() ){

			$this->Colaborador->contain();
			$this->data = $this->Colaborador->findById( $id );

		} else {
			
			if( $this->Colaborador->validates() ){
						
				if( $this->Colaborador->save( $this->request->data ) ){
					
					$this->setMessage( 'saveSuccess', 'Colaborador' );
					$this->redirect( array( 'controller' => $this->name, 'action' => 'view', $id ) );
					
				} else
					$this->setMessage( 'saveError', 'Colaborador' );
				
			} else
				$this->setMessage( 'validateError' );
		}


	
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
            'conditions' => array('Edicao.ano' => $this->ultimaEdicao),
        ));
        
        $tipo_atividades = $this->TipoAtividade->find('list', array('fields' => array('nome')));
        $atividades = array();
        foreach ($agendas as $agenda){
           if (array_key_exists($agenda['Atividade']['tipo_atividade_id'], $tipo_atividades)){
               $agenda['Atividade']['programacao_id'] = $agenda['Agenda']['id'];
               $atividades[$tipo_atividades[$agenda['Atividade']['tipo_atividade_id']]][] = $agenda['Atividade'];
               //$atividades['Agenda'] = $agenda['Agenda'];
           }
        }
        
        foreach ($atividades as $tipo_atividade => $atividade){
            foreach ($atividade as $ativ){
                 $options[$ativ['programacao_id']] = $ativ['nome_atividade'] ;
            }
        }
		
        //pr($options);
        //die();
		$this->set( "users",$this->User->find('list', array('fields'=> array('id','name')))); 
		//$this->set( "agenda",$this->Agenda->find('list', array('fields'=> array('id','atividade_cod_ativ'))));
		$this->set( "atividade",$options);

	}
	
	public function delete( $id = null ){
		
	//	$this->checkAccess( $this->name, __FUNCTION__ );
		
		$this->Colaborador->contain();
		$Colaborador = $this->Colaborador->findById( $id );
		
		if( $this->Colaborador->delete( $id ) )
			$this->setMessage( 'deleteSuccess', 'Colaborador' );
		else
			$this->setMessage( 'saveError', 'Colaborador' );
			
		$this->redirect( array( 'controller' => $this->name, 'action' => 'index' ) );
	}
		
		
	public function viewname( $name = null ){
			
	//	$this->checkAccess( $this->name, __FUNCTION__ );

		$User = $this->User->findByName($name);
		$Colaborador = $this->Colaborador->find('first', array('conditions' => array('Colaborador.user_id' => $User['User']['id'])));
		
		$agenda = $this->Agenda->find('first', array('conditions' => array('agenda.id' => $Colaborador['Colaborador']['programacao_id'], 'Edicao.ano' => $this->ultimaEdicao)));
		
		$atividade = $this->Atividade->find('first',array('conditions' => array('Atividade.id' => $agenda['Agenda']['atividade_id'])));
		

		//pr(compact("Colaborador","agenda","atividade"));
		//die();
		$this->set( compact("Colaborador","agenda","atividade") );
		

		}

	/*----------------------------------------
	 * Methods
	 ----------------------------------------*/

}