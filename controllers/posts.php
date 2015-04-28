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
            $postData = $this->getAddPostFormData();
            if ($postData === FALSE) {
                $this->errorMessage = 'All fields are mandatory!';
            } else {
                $postData['user_id'] = $this->auth->getLoggedUser()['id'];
                $postData['visits'] = 0;
                $postData['date'] = date('Y-m-d H:m:s', time());
                $isAdded = $this->model->addPost($postData);
                if ($isAdded) {
                    header("Location: " . ROOT_URL . 'posts/index'); 
                    exit();
                } else {
                    $this->errorMessage = 'Post is not recorded in database! Please try again later!';
                }
            }
        }
        
        include_once $this->layout;
    }
    
    function view($id) {
        if (!is_numeric($id)) {
            header("Location: " . ROOT_URL . 'posts/index'); 
            exit();
        }
        
        
        if (isset($_POST['submitted']) && $_POST['submitted'] == 1) {
            $commentData = $this->getAddCommentFormData();
            $commentData['post_id'] = $id;
            $commentData['date'] = date('Y-m-d H:m:s', time());
            $isAdded = $this->model->insertComment($commentData);
            if ($isAdded) {
                header("Location: " . ROOT_URL . "posts/view/$id"); 
                exit();
            } else {
                $this->errorMessage = 'Post is not recorded in database! Please try again later!';
            }
        }
        
        $template = ROOT_DIR . $this->viewsDir . 'view.php';
        
        // TODO: Test this!
        if (!isset($_POST['submitted'])){
            $this->model->updateCounter($id);
        }
        
        $post = $this->model->getPostById($id)[0];
        $comments = $this->model->getAllCommentsForPost($id);
        include_once $this->layout;
    }
    
    private function getAddCommentFormData() {
        if (empty(trim($_POST['name']))
                || empty(trim($_POST['text']))) {
            return FALSE;
        }
        
        $data = array();
        $data['author'] = $_POST['name'];
        $data['email'] = $_POST['email'] != '' ? $_POST['email'] : NULL;
        $data['text'] = $_POST['text'];
        return $data;
    }


    private function getAddPostFormData() {
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

