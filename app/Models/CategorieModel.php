<?php

namespace App\Models;

use App\Classes\Categorie;
use App\Config\Database;
use PDO;

class CategorieModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }
    // get categorie
    public function trouvercategorie($id){
        $queryFindCategorie = "SELECT * FROM categories where id = :id";
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
    public function getAllCategories(){
        $queryFindCategorie = "SELECT * FROM categories";
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
    public function savecategorie($categorie){

        $nom = $categorie->getNom();
        $description = $categorie->getDescription();

        $queryCategorie = "INSERT INTO categories (nom, description) 
                            VALUES (:nom, :description)";

        $stmtcategorie = $this->conn->prepare($queryCategorie);

        $stmtcategorie->bindParam(':nom', $nom);
        $stmtcategorie->bindParam(':description', $description);

        $stmtcategorie->execute();
    }

    // supprimer categorie
    public function supprimerCayegorie($id){
        $query = "DELETE FROM categories WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    // modifier categorie
    public function updateCategorie($categorie){
        $id = $categorie->getId();
        $nom = $categorie->getNom();
        $description = $categorie->getDescription();

        $query = "UPDATE categories 
                SET nom = :nom , description = :description
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}