<?php

namespace App\Models\Admin;

use App\Config\Database;
use PDO;


abstract class BaseModel{

    protected $conn ;
    protected $table_name ;

    public function __construct($table_name){
        $this->table_name = $table_name;
        $db = new Database();
        $this->conn = $db->connection();
    }

    abstract public function find($id);
    abstract public function getAll();
    abstract public function create($args);
    abstract public function update($args); 
    abstract public function delete($id);

}
?>