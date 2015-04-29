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
        
        // post insertation preaparation
        $queryData = array();
        $queryData['columns'] = 'user_id, text, visits, title, date';
        $queryData['values'] = 
                $postData['user_id'] . ", '" 
                . $postData['text'] . "', " 
                . $postData['visits'] . ", '"
                . $postData['title'] . "', '"
                . $postData['date'] . "'";
        
        
        // tags insertation preaparation
//        $tagsValues = "'" . implode("'), ('", $postData['tags']) . "'";
//        $tagsQueryData = array(
//            'table' => 'tags',
//            'columns' => 'text',
//            'values' => $tagsValues
//        );
        
        $this->db->autocommit(FALSE);
        $postInsertResult = $this->insert($queryData);
        $post_id = $this->db->insert_id;
        $tagsIds = array();
        foreach ($postData['tags'] as $tag) {
            $tagsQueryData = array(
                'table' => 'tags',
                'columns' => 'text',
                'values' => "'$tag'"
            );
            $tagsInsertResult = $this->insert($tagsQueryData);
            if ($tagsInsertResult == FALSE) {
                return FALSE;
            }
            
            $tagsIds[] = $this->db->insert_id;
        }
        
        // posts_tags insertation preaparation
        $postsTagsQueryData = array(
            'table' => 'posts_tags',
            'columns' => 'post_id, tag_id',
            'values' => "'$post_id', '" . implode("'), ('$post_id', '", $tagsIds) . "'"
        );
        
        $postsTagsIsnertResult = $this->insert($postsTagsQueryData);
        if ($postInsertResult == TRUE 
            && $tagsInsertResult == TRUE 
            && $postsTagsIsnertResult == TRUE) {
            $this->db->commit();
            $this->db->autocommit(TRUE);
            return TRUE;
        } else {
            $this->db->rollback();
            return FALSE;
        }
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