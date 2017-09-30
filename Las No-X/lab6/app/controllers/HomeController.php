<?php

class HomeController
{
    public $_adminOnly = [ 'stats' ];

    function index() {
        include ROOT.'app/views/index.php';
    }

    function stats() {
        $visits = array_reverse(Visit::find());

        include ROOT.'app/views/stats.php';
    }

}