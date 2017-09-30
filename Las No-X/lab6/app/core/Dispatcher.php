<?php

class Dispatcher
{
    public static function run() {
        $arg = $_GET['r'];
        $params = explode('/', $arg);
        $len = count($params);
        if ($len < 1 || $params[0] == '') {
            $params[0] = 'home';
        }
        if ($len < 2) {
            $params[1] = 'index';
        }
        $controller = ucfirst(strtolower($params[0])).'Controller';
        $method = strtolower($params[1]);
        Visit::run($controller, $method);
        try {

            $controller = new ReflectionClass($controller);
            $method = $controller->getMethod($method);
            $obj = $method->isStatic() ? null : $controller->newInstance();
            if ( Auth::instance()->is_guest && $controller->hasProperty( '_authOnly' ) && in_array( strtolower($params[1]), $controller->getProperty( '_authOnly' )->getValue( $obj ) ) ) {
                echo "Для этого действия нужна авторизация";
                return;
            }
            if ( ! Auth::instance()->is_admin && $controller->hasProperty( '_adminOnly' ) && in_array( strtolower($params[1]), $controller->getProperty( '_adminOnly' )->getValue( $obj ) ) ) {
                echo "Для этого действия вы должны быть админом";
                return;
            }
            $method->invokeArgs($obj, array_slice($params, 2));
        } catch(Exception $ex) {
            echo 'Ошибка контроллер или метод не сущетствует';
        }
    }
}