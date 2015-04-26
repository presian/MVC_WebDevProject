<?php

namespace Models;

class Master_Model {
    
    protected $table;
    protected $limit;
    protected $db;

    public function __construct($args = array()) {
        $defaults = array(
            'limit' => 0
        );
        
        $args = array_merge($defaults, $args);
        
        if (!isset($args['table'])) {
            // TODO: Make corect behavier!
            die('Table not definde.');
        }
        
        extract($args);
        
        $this->table = $table;
        $this->limit = $limit;
        
        $db_object = \Lib\Database::get_instance();
        $this->db = $db_object::getDb();
    }
    
    public function get($id) {
        return $this->find(array('where' => "id = $id"));
    }
    
    public function find($args = array()) {
        $defaults = array(
            'table' => $this->table,
            'limit' => $this->limit,
            'where' => '',
            'columns' => '*'
        );
        
        $args = array_merge($defaults, $args);
        extract($args);
        
        $query = "SELECT {$columns} FROM {$table}";
        
        if (!empty ($where)) {
            $query .= " WHERE $where";
        }
        
        if (!empty ($limit)) {
            $query .= " LIMIT $limit";
        }
        
        $resultSet = $this->db->query($query);
        $results = $this->processResultSet($resultSet);
        return $results;
    }
    
    protected function processResultSet($resultSet) {
        $result = array();
        
        if (!empty($resultSet) && $resultSet->num_rows > 0) {
            while ($row = $resultSet->fetch_assoc()){
                $result[] = $row;
            }
        }
        
        return $result;
    }
}
