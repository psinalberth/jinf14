<?php

class Edicao extends AppModel {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $name 			=	'Edicao';

	public $useTable 		= 	'edicao';

	public $label			=	'Usuário';

  	public $primaryKey        = 'id';
	
	/*----------------------------------------
	 * Associations
	 ----------------------------------------*/ 
	
	public $hasMany = array( 
		'Agenda' => array( 
			'className' => 'Agenda', 
			'foreignKey' => 'edicao_id' 
		)
	);	
	
	/*----------------------------------------
	 * Validation
	 ----------------------------------------*/
	
	public $validate 		= 	array();

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

?>