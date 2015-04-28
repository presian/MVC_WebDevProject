<?php

namespace Models;

class Post_Model extends Master_Model{
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'posts'));
    }
    
    public function getAllPosts() {
        return $this->find();
    }
    
    public function addPost($postData) {
        $queryData = array();
        $queryData['columns'] = 'user_id, text, visits, title, date';
        $queryData['values'] = 
                $postData['user_id'] . ", '" 
                . $postData['text'] . "', " 
                . $postData['visits'] . ", '"
                . $postData['title'] . "', '"
                . $postData['date'] . "'";
        return $this->insert($queryData);
    }
    
    public function getPostById($id) {
        return $this->getById($id);
    }
    
    function getAllCommentsForPost($id) {
        $queryData = array();
        $queryData['table'] = " comments";
        $queryData['where'] = " post_id = $id";
        return $this->find($queryData);
    }
    
    function insertComment($commentData) {
        $queryData = array();
        $queryData['table'] = 'comments';
        $queryData['columns'] = 'author, email, text, post_id, date';
        $queryData['values'] = 
                "'" . $commentData['author'] . "', '" 
                . $commentData['email'] . "', '" 
                . $commentData['text'] . "', '"
                . $commentData['post_id'] . "', '"
                . $commentData['date'] . "'";
        return $this->insert($queryData);
    }
    
    function updateCounter($id) {
//        $vists = $post['visits'] + 1;
//        $id = $post['id'] + 1;
        $queryData = array();
        $queryData['table'] = 'posts';
        $queryData['set'] = "visits = visits + 1";
        $queryData['where'] = "id = $id";
        return $this->update($queryData);
    }
}