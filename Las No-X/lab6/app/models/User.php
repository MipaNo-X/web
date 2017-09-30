<?php

class User extends ActiveRecord {

	protected static $table = 'users';
	protected static $fields = [
		'id',
		'name',
		'password',
		'email',
		'real_name',
		'role',
		'created_at',
		'updated_at',
	];

	public static function auth($login, $password) {
		$searchField = preg_match('/.+@.+\..+/', $login) ? 'email' : 'name';
		$user = static::findBy($searchField, $login, true);
		if($user !== false && password_verify($password, $user->password)) {
			return $user;
		}
		return false;
	}

}