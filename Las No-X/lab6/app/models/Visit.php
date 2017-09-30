<?php

class Visit extends ActiveRecord {

	protected static $table = 'visits';
	protected static $fields = [
		'id',
		'route',
		'client_id',
		'client_ip',
		'client_host',
		'client_browser',
		'created_at',
	];

	public static function run( $controller, $method = '' ) {
		$route = ( empty( $method ) || $method === 'index' ) ? $controller : $controller . '/' . $method;
		$ip    = static::get_client_ip();
		static::create( [
			'route'          => $route,
			'client_id'      => Auth::instance()->is_guest ? null : Auth::instance()->user->id,
			'client_ip'      => $ip,
			'client_host'    => gethostbyaddr( $ip ),
			'client_browser' => static::get_client_browser(),
		] );
	}

	public static function get_client_ip() {
		$ipaddress = '';
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}

	public static function get_client_browser() {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if ( strpos( $user_agent, 'Opera' ) || strpos( $user_agent, 'OPR/' ) ) {
			return 'Opera';
		} elseif ( strpos( $user_agent, 'Edge' ) ) {
			return 'Edge';
		} elseif ( strpos( $user_agent, 'Chrome' ) ) {
			return 'Chrome';
		} elseif ( strpos( $user_agent, 'Safari' ) ) {
			return 'Safari';
		} elseif ( strpos( $user_agent, 'Firefox' ) ) {
			return 'Firefox';
		} elseif ( strpos( $user_agent, 'MSIE' ) || strpos( $user_agent, 'Trident/7' ) ) {
			return 'Internet Explorer';
		}

		return 'Other';
	}

}