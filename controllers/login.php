<?php

namespace Controllers;

class Login_Controller extends Master_Controller {
    public function __construct() {
        //className, modelName, viewsDirectory
        parent::__construct(get_class(), 'login', '/views/login/');
    }
    
    function index() {
        if (isset($_POST['submitted'])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $isLogged = $this->auth->logIn($username, $password);
                if ($isLogged) {
                    $this->message['type'] = 'info';
                    $this->message['text'] = 'You are in the system now ;)';
                    header("Location: " . ROOT_URL . 'posts/index'); 
                    exit();
                }else{
                    $this->message['type'] = 'error';
                    $this->message['text'] = 'Your login data is invalid!';
                }
            } else{
                $this->message['type'] = 'error';
                $this->message['text'] = 'All fields are mandatory!';
            }
        }
        
        $template = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }    
}
