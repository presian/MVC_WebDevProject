<?php

namespace Models;

class Register_Model extends Master_Model {
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'users'));
    }
}
