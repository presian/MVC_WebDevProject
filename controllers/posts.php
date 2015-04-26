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
}

