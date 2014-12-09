<?php

class User extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'User';

	public $label			=	'Usuário';
	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	
	public $belongsTo 		= 	array( 'Profile' );
        
        public $hasMany                 =       array('Curso');

        public $hasAndBelongsToMany = array(
            'Agenda' =>
                array(
                    'className' => 'Agenda',
                    'joinTable' => 'inscricao',
                    'foreignKey' => 'user_id',
                    'associationForeignKey' => 'programacao_id',
                )
        );

	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate 		= 	array(
		
		'name' 	=> array(
			
			'rule'		=> 'notEmpty',
			'message'	=> 'Preencha Nome'
		),		
		'email' => array(
		
			'notEmpty' 	=> array(
				'rule'		=> 'notEmpty',
				'message'	=> 'Preencha Email'
			),

			'email'	=> array(
				'rule'		=> 'email',
				'message'	=> 'Email inválido'
			),

			'isUnique'	=> array(
				'rule'		=> 'isUnique',
				'message'	=> 'Este email já está cadastrado'
			)
		),

		'profile_id' => array(
			
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Selecione um Perfil'
			),

			'adminProfile' => array(
				'rule' => 'adminProfile',
				'message' => 'Você não pode criar usuários com Perfil Administrador'
			)
		),

		'password' => array(

			'notEmpty' => array(
				'rule'	=>	'passNotEmpty',
				'message'	=>	'Preencha com sua senha atual'
			),

			'currentPassword' => array(
				'rule'	=>	'currentPassword',
				'message'	=>	'Senha incorreta'
			)
		),
		
		'newPassword' => array(
		
			'newPassNotEmpty' => array(
				
				'rule' => 'newPassNotEmpty',
				'message' => 'Preencha sua nova senha'
			),

			'newPassNotSame' => array(
				
				'rule' => 'newPassNotSame',
				'message' => 'Sua nova senha não pode ser igual a senha antiga'
			),

			'between' => array(
	
				'rule' => array( 'between', 6, 20 ),
				'message' => 'Senha deve conter entre 6 e 20 caracteres',
				'allowEmpty' => true
			),

			'alphanumeric' => array(
	
				'rule' => 'alphanumeric',
				'message' => 'Senha deve conter apenas letras e/ou números (sem acentuação ou caracteres especiais)',
				'allowEmpty' => true
			)
		),

		'passwordConfirm'	=>	array(
				
			'rule'	=>	'passwordConfirm',
			'message'	=>	'Senha de Confirmação não confere'
		),  
            
               'Agenda' =>  array( 
                   'multiple' => array(
                        'rule' => array('multiple', array('min'=>1)), 
                        'required' => true,
                        'message'  => 'Você precisa escolher pelo menos um Atividade'
                  )
                ),
	);

	public function passwordConfirm( $check ){
		
		return array_pop( $check ) == $this->data[ $this->name ][ 'newPassword' ];
	}
	
	public function currentPassword( $check ){
		
		$currentPassword = $this->field( 'password' );
		return AuthComponent::password( array_pop( $check ) ) == $currentPassword;
	}

	public function passNotEmpty( $check ){
		
		return array_pop( $check ) != '';
	}

	public function newPassNotEmpty( $check ){

		if( isset( $this->_passSwitched ) ){

			if( !$this->_passSwitched ){

				$value = array_pop( $check );
				return !empty( $value );
			}
		}
		
		return true;
	}
	
	public function newPassNotSame( $check ){

		if( isset( $this->_passSwitched ) ){
			
			if( !$this->_passSwitched ){
				
				$currentPassword = $this->field( 'password' );
				return AuthComponent::password( array_pop( $check ) ) != $currentPassword;
			}
		}
		
		return true;
	}

	public function adminProfile( $check ){
		
		if( !$this->isAdmin() )
			return array_pop( $check ) != Configure::read( 'AdminProfileId' );

		return true;
	}

	/*----------------------------------------
	 * Methods
	 ----------------------------------------*/
	
	public function lastLogin( $user_id ){
		
		$this->id = $user_id;
		$this->saveField( 'last_login', date('Y-m-d H:i:s') );
	}

	public static function isAdmin( $profile_id = null ){

		if( !$profile_id )
			$profile_id = AuthComponent::user( 'profile_id' );

		return $profile_id == Configure::read( 'AdminProfileId' );
	}

	public static function isAdminUser( $user_id = null ){

		if( !$user_id )
			$user_id = AuthComponent::user( 'id' );

		return $user_id == Configure::read( 'AdminUserId' );
	}

	/*----------------------------------------
	 * Callbacks
	 ----------------------------------------*/

	public function beforeValidate( $options = array() ){

		if( array_key_exists( 'pass_switched', $options ) ){

			$this->_passSwitched = $options[ 'pass_switched' ];

			if( !$this->_passSwitched ){

				$this->validate[ 'newPassword' ][ 'alphanumeric' ][ 'allowEmpty' ] = false;
				$this->validate[ 'newPassword' ][ 'between' ][ 'allowEmpty' ] = false;
			}
		}

                
                foreach($this->hasAndBelongsToMany as $k => $v) { 
                    if(isset($this->data[$k][$k])) 
                    { 
                       $programaca_id = $this->data[$this->alias][$k] = $this->data[$k][$k];
                       
                       $atividade = $this->Agenda->find('first', array(
                           'conditions' => array(
                               'Agenda.id' => $programaca_id
                           ),
                           'fields' => array('Atividade.id', 'Atividade.vagas', 'Agenda.horario_ini', 'Agenda.horario_fim', 'Agenda.data')
                       ));
                       
                       
                       $horarios_ini_escolhidos_participante[] = "{$atividade['Agenda']['data']}/{$atividade['Agenda']['horario_ini']}";
                       pr($horarios_ini_escolhidos_participante); die;
                       if ($atividade['Atividade']['vagas'] == 0){
                           $this->validationErrors['vagas'] = 'Total de vagas já preenchidas para alguma Atvidade escolhida!';
                           return false;
                       }
                       
                    } 
                }
                
                //Se a função array_unique retornar alguma coisa é porque existe horários duplicados no array, consequentemente há conflitos de horário!
                if (!empt(array_unique($input))){
                    $this->validationErrors['horario_conflito'] = 'Você deve escolher hoŕários que não conflitem!';
                    return false;
                }
		return true;
	}
	
	public function beforeSave(){

		if( !$this->id )
			$this->data[ $this->name ][ 'password' ] = AuthComponent::password( '123456' );

		elseif( !empty( $this->data[ $this->name ][ 'newPassword' ] ) ){

			$this->data[ $this->name ][ 'password' ] = AuthComponent::password( $this->data[ $this->name ][ 'newPassword' ] );
			unset( $this->data[ $this->name ][ 'newPassword' ] );

			if( !empty( $this->data[ $this->name ][ 'passwordConfirm' ] ) )
				unset( $this->data[ $this->name ][ 'passwordConfirm' ] );

			if( isset( $this->_passSwitched ) )
				if( !$this->_passSwitched )
					$this->_passSwitched = $this->data[ $this->name ][ 'pass_switched' ] = '1';

		} elseif( isset( $this->data[ $this->name ][ 'password' ] ) )
			unset( $this->data[ $this->name ][ 'password' ] );

		if( isset( $this->data[ $this->name ][ 'pass_switched' ] ) )
			if( !$this->data[ $this->name ][ 'pass_switched' ] )
				unset( $this->data[ $this->name ][ 'pass_switched' ] );
		
		return true;
	}
	
}