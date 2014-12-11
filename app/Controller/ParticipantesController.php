<?php

class ParticipantesController extends AppController{
	
/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 

	public $name	= "Participantes";
	
	public $setMenu	= "Participantes";

	public $label = 'Agenda';

	public $submenu	= array( 'index', 'add' );

	public $uses = array('Atividade', 'TipoAtividade','Agenda', 'Profile', 'Edicao','Sala');

	public $layout = 'layout2';

	
	/*----------------------------------------
	 * Actions
	 ----------------------------------------*/
	
	public function consultarHorarioIndividual(){
            $this->checkAccess($this->name,__FUNCTION__);
            $this->Agenda->contain();
            $agenda = $this->Agenda->find('first', array('conditions'=>array('Agenda.id'=>$id)));
            
            $this->set("agenda", $agenda);
        }
        
        public function solicitarCertificado(){
            
            
        }
}
?>
