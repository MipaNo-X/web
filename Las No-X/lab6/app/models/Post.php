<?php

class Post extends ActiveRecord {

	protected static $table = 'posts';
	protected static $fields = [
		'id',
		'title',
		'message',
		'image',
		'created_at',
	];

}