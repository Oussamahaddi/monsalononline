
<?php

    class Users extends Controller {
        private $userModel;

        public function __construct() {
            $this->userModel = $this->model('User');
        }

        ////////////////////////////////////////////// Registre method \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        public function registre() {

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
        
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);      
                $dataa = json_decode(file_get_contents("php://input"));
                // Init data
                $data =[
                    'fname' => trim($dataa->first_name),
                    'lname' => trim($dataa->last_name),
                    'phone' => trim($dataa->phone),
                    'token' => 'M-' . $this->generateRandome(substr($dataa->phone, 2, 2)),
                    'fname_err' => '',
                    'lname_err' => '',
                    'phone_err' => '',
                ];

                // Validate phone
                if($this->userModel->findByPhone($data['phone'])){
                    $data['phone_err'] = 'Phone numbre is already taken';
                    echo json_encode(['message' => false]);
                } else {
                    if($this->userModel->registre($data)){
                        echo json_encode(['message' => $data['token']]);
                    } else {
                        echo json_encode(['message' => 'failed !!!!']);
                    }
                }


                // Make sure errors are empty
                // if(empty($data['fname_err']) && empty($data['lname_err']) && empty($data['phone_err'])){
                //     // Register User
                //     if($this->userModel->setClient($data)){
                //         echo json_encode(['message' => 'Registre succee !!!!']);
                //     } else {
                //         echo json_encode(['message' => 'failed !!!!']);
                //     }

                // }

            }
        }


        ////////////////////////////////////////////// login method \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        public function login() {

            // check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // get data from vue
                $receive = json_decode(file_get_contents("php://input"));
                // init data
                $data = [
                    'token' => trim($receive->token_input),
                    'token_err' => ''
                ];

                // validate password
                if (empty($data['token'])) {
                    $data['token_err'] = 'Please enter token';
                } else {
                    // Check token
                    $user = $this->userModel->checkUser($data);
                    if($user){
                        // $this->createSession($user);
                        echo json_encode(['message' => $user]);
                    } else {
                        echo json_encode(['message' => false]);
                    }
                }

                // check if there is no erreur
                // if (empty($data['token_err'])) {
                //     // check for validate email
                //     $loginAdmCechk = $this->userModel->checkUser($data['token']);

                //     if ($loginAdmCechk) {
                //         // create session
                //     } else if ($loginClientCheck) {
                //         // if not admin
                //         $this->createSession($loginClientCheck);
                //     } else {
                //         $data['Email_Password_err'] = 'Email or Password incorrect !!!';
                //         $this->view('log/login', $data);
                //     }
                // }


            }
        }


        // public function createSession($data) {
        //     // create session of admin and client
        //     $_SESSION['token'] = $data->first_name;
        //     echo json_encode(['message' => true]);
        // }


        public function logOutAdmin() {
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            session_destroy();
        }

        public function generateRandome($phone) {
            $character = "ABCDEFGHIJKLMNOPRSTQUVWXYZ0123456789";
            $length = 6;
            $token = '';
            $finalToken = '';
            for ($i = 0; $i < $length; $i++) {
                $token .= $character[random_int(0, strlen($character) - 1)];
            }
            $finalToken = $token . $phone;

            return $finalToken;
        }

    }