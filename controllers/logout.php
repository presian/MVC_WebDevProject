<?php
namespace Controllers;
class Logout_Controller extends Master_Controller {
    public function __construct() {
        parent::__construct(get_class(), NULL, NULL);
    }
    
    public function index() {
        session_destroy();
        header("Location: " . HOME_URL); 
        exit();
    }
}
