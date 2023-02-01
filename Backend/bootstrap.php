
<?php

    header("Access-Control-Allow-Origin: *");
    header("content-type: Application/json");
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // autoload core liberaries
    spl_autoload_register(function ($className) {
        require_once 'libraries/' . $className . '.php';
    });

