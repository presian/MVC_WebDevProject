<?php

namespace Controllers;

class Posts_Controller extends Master_Controller {
    public function __construct() {
        parent::__construct(get_class(), 'post', '/views/posts/');
    }
    
    function index() {
        $tagName = NULL;
        if (isset($_POST['searched']) && $_POST['searched'] == 1) {
            if (isset($_POST['tagName'])) {
                $tagName = $_POST['tagName'];
            }
        }
        
        $template = ROOT_DIR . $this->viewsDir . 'index.php';        
        $postsResult = $this->model->getAllPosts($tagName);
        $posts = array();
        foreach ($postsResult as $post) {
            $post['tags'] = $this->model->getTagsForPost($post['id']);
            $posts[] = $post;
        }
        
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
                $this->message['type'] = 'error';
                $this->message['text'] = 'All fields are mandatory!';
            } else {
                $postData['user_id'] = $this->auth->getLoggedUser()['id'];
                $postData['visits'] = 0;
                $postData['date'] = date('Y-m-d H:m:s', time());
                $isAdded = $this->model->addPost($postData);
                if ($isAdded) {
                    $this->message['type'] = 'info';
                    $this->message['text'] = 'Your post in the system now ;)';
                    header("Location: " . ROOT_URL . 'posts/index'); 
                    exit();
                } else {
                    $this->message['type'] = 'error';
                    $this->message['text'] = 'Post is not recorded in database! Please try again later!';
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
                $this->message['type'] = 'info';
                $this->message['text'] = 'Your comment in the system now ;)';
                header("Location: " . ROOT_URL . "posts/view/$id"); 
                exit();
            } else {
                $this->message['type'] = 'error';
                $this->message['text'] = 'Post is not recorded in database! Please try again later!';
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
                || empty(trim($_POST['tags'])) 
                || empty(trim($_POST['text']))) {
            return FALSE;
        }
        $title = $_POST['title'];
        $text = $_POST['text'];
        $tags = preg_split( "/[\s,|\.:;&<>\?=@+\-!\\\\\/]+/", $_POST['tags']);
        
        if (!is_array($tags) || count($tags) < 1) {
            return FALSE;
        }
        
        $data = array();
        $data['title'] = $title;
        $data['text'] = $text;
        $data['tags'] = $tags;
        return $data;
    }
}

