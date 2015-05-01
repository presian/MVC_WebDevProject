<?php

namespace Models;

class Post_Model extends Master_Model{
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'posts'));
    }
    
    public function getAllPosts($tagName = NULL) {
        if ($tagName != NULL) {
            $tagName = '%' . mysql_real_escape_string($tagName) . '%';
            $statement = $this->db->prepare(
            "SELECT 
                p.id,
                p.text,
                p.user_id,
                p.visits,
                p.title,
                p.date    
            FROM posts p
            LEFT JOIN posts_tags pt
            ON p.id = pt.post_id
            LEFT JOIN tags t
            ON pt.tag_id = t.id
            WHERE t.text LIKE ?
            ORDER BY p.DATE DESC");
            $statement->bind_param("s", $tagName);
            return $this->exuteStatement($statement);
        }
        
        return $this->find(array('order' => 'date DESC'));
    }
    
    public function getTagsForPost($postId){
        $statement = $this->db->prepare(
        "SELECT 
            t.id,
            t.text
        FROM tags t
        JOIN posts_tags pt
        ON t.id = pt.tag_id
        WHERE pt.post_id = ?
        LIMIT 5");

        $statement->bind_param("i", $postId);
        return $this->exuteStatement($statement);
    }
    
    public function addPost($postData) {
        
        // post insertation preaparation
        $queryData = array();
        $queryData['columns'] = 'user_id, text, visits, title, date';
        $queryData['values'] = 
                 mysql_real_escape_string($postData['user_id']) . ", '" 
                . mysql_real_escape_string($postData['text']) . "', " 
                . mysql_real_escape_string($postData['visits']) . ", '"
                . mysql_real_escape_string($postData['title']) . "', '"
                . mysql_real_escape_string($postData['date']) . "'";
        
        $this->db->autocommit(FALSE);
        $postInsertResult = $this->insert($queryData);
        $post_id = $this->db->insert_id;
        $tagsIds = array();
        foreach ($postData['tags'] as $tag) {
            $tagsQueryData = array(
                'table' => 'tags',
                'columns' => 'text',
                'values' => "'" . mysql_real_escape_string($tag) . "'"
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
        $queryData['where'] = " post_id = " . mysql_real_escape_string($id);
        return $this->find($queryData);
    }
    
    function insertComment($commentData) {
        $queryData = array();
        $queryData['table'] = 'comments';
        $queryData['columns'] = 'author, email, text, post_id, date';
        $queryData['values'] = 
                "'" . mysql_real_escape_string($commentData['author']) . "', '" 
                . mysql_real_escape_string($commentData['email']) . "', '" 
                . mysql_real_escape_string($commentData['text']) . "', '"
                . mysql_real_escape_string($commentData['post_id']) . "', '"
                . mysql_real_escape_string($commentData['date']) . "'";
        return $this->insert($queryData);
    }
    
    function updateCounter($id) {
        $queryData = array();
        $queryData['table'] = 'posts';
        $queryData['set'] = "visits = visits + 1";
        $queryData['where'] = "id = " . mysql_real_escape_string($id);
        return $this->update($queryData);
    }
}