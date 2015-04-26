<?php

namespace Controllers;

class Login_Controller extends Master_Controller {
    public function __construct() {
        //className, modelName, viewsDirectory
        parent::__construct(get_class(), 'login', '/views/login/');
    }
    
    function index() {
        $errorMessage = NULL;
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $isLogged = $this->auth->logIn($username, $password);
            if ($isLogged) {
                header("Location: " . ROOT_URL . 'posts/index'); 
                exit();
            }else{
                $this->errorMessage = 'Your login data is invalid!';
            }
        }
        $template = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }    
}
