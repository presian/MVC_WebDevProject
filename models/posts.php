<?php

namespace Models;

class Posts_Model extends Master_Model{
    public function __construct() {
        parent::__construct(array('table' => 'posts'));
    }
}