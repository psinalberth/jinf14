<?php

class Atividade extends AppModel {
    
    /* ----------------------------------------
     * Atributtes
      ---------------------------------------- */

    public $name = 'Atividade';
    public $useTable = 'atividade';
    public $label = 'Atividade';


    /* ----------------------------------------
     * Associations
      ---------------------------------------- */
    public $belongsTo = array(
        'TipoAtividade' => array(
            'className' => 'TipoAtividade',
            'foreignKey' => 'tipo_atividade_id'
        )
    );
    /* public $hasMany = array( 
        'Agenda' => array(
            'className' => 'Agenda',
            'foreignKey' => 'atividade_cod_ativ'
        )
      ); */

    
    /* ----------------------------------------
     * Validation
      ---------------------------------------- */
    public $validate = array(
        'nome_atividade' => array('rule' => 'notEmpty', 'message' => 'Este Campo não pode ser Vazio!'),
        'tipo_atividade_id' => array('rule' => 'notEmpty', 'message' => 'Este Campo não pode ser Vazio!'),
        'duracao' => array('notEmpty' => array('rule' => 'notEmpty', 'message' => 'Este Campo não pode ser Vazio!'), 'numeric' => array('rule' => 'numeric', 'message' => 'Somente números')),
        'vagas' => array('notEmpty' => array('rule' => 'notEmpty', 'message' => 'Este Campo não pode ser Vazio!'), 'numeric' => array('rule' => 'numeric', 'message' => 'Somente números'))
    );

    /* ----------------------------------------
     * Methods
      ---------------------------------------- */


    /* ----------------------------------------
     * Callbacks
      ---------------------------------------- */

    public function beforeValidate($options = array()) {
        
    }

    public function beforeSave() {
        
    }
}
?>