
<?php

// load modeles and views

class Controller {
    // load model
    public function model($model) {
        // require model file
        require_once '../modules/' . $model .'.php';
        // instatiate model
        return new $model();
    }
}