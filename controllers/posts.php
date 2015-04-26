<?php

namespace Controllers;

class Posts_Controller extends Master_Controller {
    public function __construct() {
        parent::__construct('/views/posts/');
    }
    
    function index() {
        $template = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }
}

