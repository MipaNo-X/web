<?php

class Auth {

	/**
	 * @var Auth
	 */
	protected static $_instance;
	public $user = false;
	public $is_admin = false;
	public $is_guest = true;

	private function __construct() {
	}

	public function load() {
		if(!session_id()) {
			session_start();
		}
		$this->is_admin = false;
		if(array_key_exists('login', $_SESSION) && array_key_exists('password', $_SESSION)) {
			$this->user = User::auth($_SESSION['login'], $_SESSION['password']);
			if($this->user !== false) {
				$this->is_guest = false;
				if($this->user->role == 'admin') {
					$this->is_admin = true;
				}
			}
		}
	}

	public function logout() {
		session_destroy();
	}

	public static function init() {
		static::instance()->load();
	}

	public static function instance(): Auth {
		if ( is_null( static::$_instance ) ) {
			static::$_instance = new static();
		}

		return static::$_instance;
	}

	public static function __callStatic( $name, $arguments ) {
		return call_user_func_array( [ static::instance(), $name ], $arguments );
	}

}