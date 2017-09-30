<?php
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
include ROOT . 'load.php';
date_default_timezone_set('Europe/Moscow');
Database::init();
Auth::init();
Dispatcher::run();