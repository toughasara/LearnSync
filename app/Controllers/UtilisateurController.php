<?php

namespace App\Controllers;
use App\Classes\Utilisateur;
use App\Models\UtilisateurModel;

class UtilisateurController{

    private UtilisateurModel $UtilisateurModel;

    public function __construct()   {
        $this->utilisateurModel = new UtilisateurModel();
    }

    
    // get tout les Enseignants
    public function getEnseignants(){
        return $this->utilisateurModel->getAllEnseignants();
    }

    // get tout les Etudiants
    public function getEtudiants(){
        return $this->utilisateurModel->getAllEtudiants();
    }

    // supprimer un utilisateur 
    public function deleteCategoryById($category_id){
        $id = $category_id;
        $this->categorieModel->supprimerCayegorie($id);
    }

}