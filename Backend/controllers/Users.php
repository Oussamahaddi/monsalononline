
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

                // Init data
                $data =[
                    'fname' => trim($_POST['first_name']),
                    'lname' => trim($_POST['last_name']),
                    'phone' => trim($_POST['phone']),
                    'token' => 'M-' . $this->generateRandome(substr($_POST['phone'], 2, 2)),
                    'fname_err' => '',
                    'lname_err' => '',
                    'phone_err' => '',
                ];

                // Validate fname
                if(empty($data['first_name'])){
                    $data['fname_err'] = 'Pleae enter Full Name';
                }
                // Validate lname
                if(empty($data['last_name'])){
                    $data['lname_err'] = 'Pleae enter email';
                }
                // Validate phone
                if(empty($data['phone'])){
                    $data['phone_err'] = 'Pleae enter Phone numbre';
                } else {
                    // Check phone
                    if($this->userModel->findByPhone($data['phone'])){
                        $data['phone_err'] = 'Phone numbre is already taken';
                        echo json_encode(['message' => 'this numbre is already exist']);
                    } else {
                        if($this->userModel->registre($data)){
                            echo json_encode(['message' => $data['token']]);
                        } else {
                            echo json_encode(['message' => 'failed !!!!']);
                        }
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
                // process form
                // sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // init data
                $data = [
                    'token' => trim($_POST['token']),
                    'token_err' => ''
                ];

                // validate password
                if (empty($data['token'])) {
                    $data['token_err'] = 'Please enter token';
                } else {
                    // Check token
                    if($this->userModel->checkUser($data)){
                        echo json_encode(['message' => 'login succe']);
                    } else {
                        echo json_encode(['message' => 'login failed !!!!']);
                    }
                }

                // check if there is no erreur
                // if (empty($data['token_err'])) {
                //     // check for validate email
                //     $loginAdmCechk = $this->userModel->checkUser($data['token']);

                //     if ($loginAdmCechk) {
                //         // create session
                //         $this->createSession($loginAdmCechk);
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


        // public function createSession($unkown) {
        //     // create session of admin and client
        //     $_SESSION['Email'] = $unkown->email;
        //     if ($_SESSION['Email'] == 'oussama@gmail.com') {
        //         redirect('Dashboards/statistique');
        //     } else {
        //         $_SESSION['name'] = $unkown->full_name;
        //         $_SESSION['id'] = $unkown->id;
        //         redirect('Pages/index');
        //     }
        // }


        // public function logOutAdmin() {
        //     unset($_SESSION['Email']);
        //     unset($_SESSION['id']);
        //     unset($_SESSION['name']);
        //     session_destroy();
        //     redirect('allPages/index');
        // }

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