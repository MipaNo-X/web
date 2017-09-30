<?php

class UserVerification extends Validation {

	protected $_method;

	public static function run( array $rules, array $messages = [], $method = 'sign_in' ) {
		$validator          = new static( $_POST, $rules, $messages );
		$validator->_method = $method;
		if ( ! empty( $validator->_form ) ) {
			$validator->validate();
		}

		return $validator;
	}

	public function validate() {
		parent::validate();

		if ( $this->_method == 'sign_up' && ! empty( $this->_errors ) ) {
			$this->verify();
		}

		return $this;
	}

	public function verify() {
		switch ( $this->_method ) {
			case 'sign_in':
				$this->verifySignIn();
				break;
			case 'sign_up':
				$this->verifySignUp();
				break;
		}
	}

	public function verifySignIn() {
		$user = User::auth( $this->_form['login'], $this->_form['password'] );
		if ( $user !== false ) {
			$this->_result = 'Вы успешно авторизованы';
		} else {
			$this->_errors['login'] = $this->errorMessage( 'login', 'sign_in' );
		}
	}

	public function verifySignUp() {
		$by_name  = User::findBy( 'name', $this->_form['name'], true );
		$by_email = User::findBy( 'email', $this->_form['email'], true );

		if ( $by_name !== false ) {
			$this->_errors['name'] = $this->errorMessage( 'name', 'sign_up' );
		}
		if ( $by_email !== false ) {
			$this->_errors['email'] = $this->errorMessage( 'email', 'sign_up' );
		}
		if ( empty( $this->_errors ) ) {
			$this->_result = 'Вы успешно зарегистрированы';
		}
	}

}