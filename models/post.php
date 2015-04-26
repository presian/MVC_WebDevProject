<?php

namespace Models;

class Post_Model extends Master_Model{
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'posts'));
    }
    
    public function getAllPosts() {
        return $this->find();
    }
}