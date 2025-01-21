<?php

namespace App\Models\Admin;

use App\Classes\Categorie;
use App\Models\Admin\BaseModel;
use App\Config\Database;
use PDO;


class CategorieModel extends BaseModel{

    public function __construct() {
        parent::__construct('categories');
        $db = new Database();
        $this->conn = $db->connection();
    }

    // get categorie
    public function find($id){
        $queryFindCategorie = "SELECT * FROM $this->table_name where id = :id";
        $stmtselectCategorie = $this->conn->prepare($queryFindCategorie);
        $stmtselectCategorie->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmtselectCategorie->execute();
        $categorie = $stmtselectCategorie->fetch(\PDO::FETCH_ASSOC);
        if ($categorie) {
            return new Categorie($categorie['id'], $categorie['nom'], $categorie['description']);
        } else {
            return null;
        }
    }

    // get tout les categories
    public function getAll(){
        $queryFindCategorie = "SELECT * FROM $this->table_name";
        $stmtselectCategorie = $this->conn->prepare($queryFindCategorie);
        $stmtselectCategorie->execute();
        $categories = $stmtselectCategorie->fetchAll(\PDO::FETCH_ASSOC);

        $category_objects = [];
        foreach ($categories as $category) {
            $category_objects [] = new Categorie($category['id'],$category['nom'],$category['description'] );
        }

        return $category_objects;
    }
    
    // savecategorie
    public function create($categorie){

        $nom = $categorie->getNom();
        $description = $categorie->getDescription();

        $queryCategorie = "INSERT INTO $this->table_name (nom, description) 
                            VALUES (:nom, :description)";

        $stmtcategorie = $this->conn->prepare($queryCategorie);

        $stmtcategorie->bindParam(':nom', $nom);
        $stmtcategorie->bindParam(':description', $description);

        $stmtcategorie->execute();
    }

    // supprimer categorie
    public function delete($id){
        $query = "DELETE FROM $this->table_name WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    // modifier categorie
    public function update($categorie){
        $id = $categorie->getId();
        $nom = $categorie->getNom();
        $description = $categorie->getDescription();

        $query = "UPDATE $this->table_name 
                SET nom = :nom , description = :description
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}