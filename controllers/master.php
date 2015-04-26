<?php

namespace Controllers;

class Master_Controller{
    
    protected $layout;

    protected $viewsDir;
    
    public function __construct($viewsDir = '/views/master') {
        $this->viewsDir = $viewsDir;
        $this->layout = ROOT_DIR . '/views/layouts/default.php';
    }
}

