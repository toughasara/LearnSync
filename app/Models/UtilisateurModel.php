<?php

namespace App\Models;

use App\Classes\Utilisateur;
use App\Config\Database;
use PDO;

class UtilisateurModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }

    // get tout les Enseignants
    public function getAllEnseignants(){
        $queryFindEnseignant = "SELECT * FROM utilisateurs WHERE role = 'enseignant'";
        $stmtselectEnseignant = $this->conn->prepare($queryFindEnseignant);
        $stmtselectEnseignant->execute();
        $enseignants = $stmtselectEnseignant->fetchAll(\PDO::FETCH_ASSOC);
        
        $enseignant_objects = [];
        foreach ($enseignants as $enseignant) {
            $enseignant_objects [] = new Utilisateur($enseignant['id'],$enseignant['nom'],$enseignant['email'],$enseignant['password'],$enseignant['role'],$enseignant['status'],$enseignant['created_at']);
        }

        return $enseignant_objects;
    }

    // get tout les Enseignants
    public function getAllEtudiants(){
        $queryFindEtudiant = "SELECT * FROM utilisateurs WHERE role = 'etudiant'";
        $stmtselectEtudiant = $this->conn->prepare($queryFindEtudiant);
        $stmtselectEtudiant->execute();
        $etudiants = $stmtselectEtudiant->fetchAll(\PDO::FETCH_ASSOC);
        
        $etudiant_objects = [];
        foreach ($etudiants as $etudiant) {
            $etudiant_objects [] = new Utilisateur($etudiant['id'],$etudiant['nom'],$etudiant['email'],$etudiant['password'],$etudiant['role'],$etudiant['status'],$etudiant['created_at']);
        }

        return $etudiant_objects;
    }

    // supprimer categorie
    public function supprimerCayegorie($id){
        $query = "DELETE FROM categories WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }


}