<?php

namespace Controllers;

class Posts_Controller extends Master_Controller {
    public function __construct() {
        parent::__construct(get_class(), 'post', '/views/posts/');
    }
    
    function index() {
        $template = ROOT_DIR . $this->viewsDir . 'index.php';        
        $posts = $this->model->getAllPosts();

        include_once $this->layout;
    }
    
    function add() {
        if (!$this->auth->isLogged()) {
            header("Location: " . HOME_URL); 
            exit();
        }
        
        $template = ROOT_DIR . $this->viewsDir . 'add.php';
        if (isset($_POST['submitted']) && $_POST['submitted'] == 1 ) {
            $postData = $this->getFormData();
            if ($postData === FALSE) {
                $this->errorMessage = 'All fields are mandatory!';
            } else {
                $postData['user_id'] = $this->auth->getLoggedUser()['id'];
                $postData['visits'] = 0;
                $isAdded = $this->model->addPost($postData);
                if ($isAdded) {
                    header("Location: " . HOME_URL); 
                    exit();
                } else {
                    $errorMessage = 'Post is not recorded in database! Please try again later!';
                }
            }
        }
        
        include_once $this->layout;
    }
    
    private function getFormData() {
        if (empty(trim($_POST['title'])) 
                || empty(trim($_POST['text']))) {
            return FALSE;
        }
        $data = array();
        $data['title'] = $_POST['title'];
        $data['text'] = $_POST['text'];
        return $data;
    }
}

