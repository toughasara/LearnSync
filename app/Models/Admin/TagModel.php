<?php

namespace App\Models\Admin;

use App\Classes\Tag;
use App\Models\Admin\BaseModel;
use App\Config\Database;
use PDO;

class TagModel extends BaseModel{

    public function __construct() {
        parent::__construct('tags');
        $db = new Database();
        $this->conn = $db->connection();
    }

    // get tag
    public function find($id){
        $queryFindTag = "SELECT * FROM $this->table_name where id = :id";
        $stmtselectTag = $this->conn->prepare($queryFindTag);
        $stmtselectTag->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmtselectTag->execute();
        $tag = $stmtselectTag->fetch(\PDO::FETCH_ASSOC);
        if ($tag) {
            return new Tag($tag['id'], $tag['nom']);
        } else {
            return null;
        }
    }

    // get tout les tags
    public function getAll(){
        $queryFindTag = "SELECT * FROM $this->table_name";
        $stmtselectTag = $this->conn->prepare($queryFindTag);
        $stmtselectTag->execute();
        $tags = $stmtselectTag->fetchAll(\PDO::FETCH_ASSOC);

        $tags_objects = [];
        foreach ($tags as $tag) {
            $tags_objects [] = new Tag($tag['id'],$tag['nom']);
        }

        return $tags_objects;
    }
    
    // save tag 
    public function create($tag){

        $nom = $tag->getNom();

        $querytag = "INSERT INTO $this->table_name (nom) 
                            VALUES (:nom)";

        $stmttag = $this->conn->prepare($querytag);

        $stmttag->bindParam(':nom', $nom);

        $stmttag->execute();
    }

    // supprimer tag
    public function delete($id){
        $query = "DELETE FROM $this->table_name WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    // modifier tag
    public function update($tag){
        $id = $tag->getId();
        $nom = $tag->getNom();

        $query = "UPDATE $this->table_name 
                SET nom = :nom 
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}