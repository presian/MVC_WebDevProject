<?php

namespace Controllers;

class Master_Controller{
    
    protected $layout;
    protected $viewsDir;
    
    public function __construct(
            $className = '\Controllers\Master_Controller',
            $model = 'master',
            $viewsDir = '/views/master') {
        
        $this->viewsDir = $viewsDir;
        $this->className = $className;
        $this->errorMessage = NULL;
        $this->successMessage = NULL;
        
        if ($model != NULL) {
            include_once ROOT_DIR . "/models/{$model}.php";
            $modelClass = "\Models\\" . ucfirst($model) . '_Model';
            $this->model = new $modelClass(
                array(
                    'table'=> 'none'
                )
            );
        }
        
        $this->auth = \Lib\Auth::get_instance();
        $loggedUser = $this->auth->getLoggedUser();
        $this->loggedUser = $loggedUser;
        $this->layout = ROOT_DIR . '/views/layouts/default.php';
    }
    
    function makeDateInFormat($dateStr) {
        $date = new \DateTime($dateStr); 
        return $date->format('d M y');
    }
}

