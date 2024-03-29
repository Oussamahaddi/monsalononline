<?php

    class Appoinements extends Controller {
        private $appoinmenentModel;
        public function __construct() {
            $this->appoinmenentModel = $this->model('Appoinement');
        }

        public function addApp() {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize POST data
                $recieve = json_decode(file_get_contents("php://input"));
                // Init data
                $data =[
                    'id_client' => trim($recieve->id_client),
                    'date' => trim($recieve->date),
                    'time' => trim($recieve->time),
                ];
                $setIt = $this->appoinmenentModel->setAppoinement($data);
                // Check if is set it
                if($setIt){
                    // echo the message if the appoinement set
                    echo json_encode(['message' => 'appoinement set', 'seted' => true]);
                } else {
                    echo json_encode(['message' => 'something wrong !!!!!!']);
                }
            }
        }

        public function updateApp($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // get appoinement by id that want to edit
                $appoinements = $this->appoinmenentModel->getAppById($id);
                // Init data
                $data =[
                    'id' => $appoinements->id,
                    'id_client' => $_SESSION['id'],
                    'date' => date('d-m-y'),
                    'time' => date('h'),
                    'date_err' => '',
                    'time_err' => '',
                ];
                // Validate fname
                if(empty($data['date'])){
                    $data['date_err'] = 'Pleae enter date';
                }
                // Validate lname
                if(empty($data['time'])){
                    $data['time_err'] = 'Pleae enter time';
                }
                $setIt = $this->appoinmenentModel->updatAppoinement($data);
                // Check if is set it
                if($setIt){
                    // echo the message if the appoinement set
                    echo json_encode(['message' => 'appoinement updated']);
                } else {
                    echo json_encode(['message' => 'something wrong !!!!!!']);
                }
            }
        }

        public function deleteApp($id) {
            $deletApp = $this->appoinmenentModel->deleteAppoinement($id);
            // Check if is set it
            if($deletApp){
                // echo the message if the appoinement removed
                echo json_encode(['message' => 'appoinement deleted', 'deleted' => true]);
            } else {
                echo json_encode(['message' => 'something wrong !!!!!!']);
            }
        }

        public function show() {
            echo $this->appoinmenentModel->getAllApp();
        }

        public function getAppByUser($id) {
            echo json_encode($this->appoinmenentModel->getAppByUser($id));
        }
    }