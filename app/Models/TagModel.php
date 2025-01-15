<?php

namespace App\Models;

use App\Classes\Tag;
use App\Config\Database;
use PDO;

class TagModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }

    // get tag
    public function trouvertag($id){
        $queryFindTag = "SELECT * FROM tags where id = :id";
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
    public function getAllTags(){
        $queryFindTag = "SELECT * FROM tags";
        $stmtselectTag = $this->conn->prepare($queryFindTag);
        $stmtselectTag->execute();
        $tags = $stmtselectTag->fetchAll(\PDO::FETCH_ASSOC);

        $tags_objects = [];
        foreach ($tags as $tag) {
            $tags_objects [] = new Tag($tag['id'],$tag['nom'],$tag['description'] );
        }

        return $tags_objects;
    }
    
    // save tag 
    public function saveTag($tag){

        $nom = $tag->getNom();

        $querytag = "INSERT INTO tags (nom) 
                            VALUES (:nom)";

        $stmttag = $this->conn->prepare($querytag);

        $stmttag->bindParam(':nom', $nom);

        $stmttag->execute();
    }

    // supprimer tag
    public function supprimertag($id){
        $query = "DELETE FROM tags WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    // modifier tag
    public function updateTag($tag){
        $id = $tag->getId();
        $nom = $tag->getNom();

        $query = "UPDATE tags 
                SET nom = :nom 
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}