

<?php 

    class Pages extends Controller {
        private $modelClient;
        public function __construct() {
            // instatiate object from model client and affet it to the property
            $this->modelClient = $this->model('User');
        }

        public function index() {
            // home page
            $res = $this->modelClient->getAllClient();
            echo json_encode($res);
        }
        

    }