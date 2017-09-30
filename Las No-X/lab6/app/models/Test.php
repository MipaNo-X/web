<?php

class Test extends ActiveRecord {

	protected static $table = 'tests';
	protected static $fields = [
		'id',
		'name',
		'group',
		'a1',
		'a2',
		'a3',
		'v1',
		'v2',
		'v3',
		'created_at',
	];

}