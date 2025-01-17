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

    // soft delet un utilisateur 
    public function softDeleteUser($id) {
        return $this->utilisateurModel->softDeleteUser($id);
    }

    // changer le statut 
    public function updateUserStatus($id, $status) {
        return $this->utilisateurModel->updateUserStatus($id, $status);
    }


}