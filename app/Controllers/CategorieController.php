<?php

namespace App\Controllers;
use App\Classes\Categorie;
use App\Models\CategorieModel;

class CategorieController{

    private CategorieModel $categorieModel;

    public function __construct()   {
        $this->categorieModel = new CategorieModel();
    }

    // ajouter une categorie
    public function addcategorie($nom,$description){
        $categorie = new Categorie(null, $nom,$description);
        $this->categorieModel->savecategorie($categorie);
    }

    // get tout les categories
    public function getCategories(){
        return $this->categorieModel->getAllCategories();
    }

    // modifier une categorie
    public function updateCategorie($category_id, $nom , $description){
        $categorie = new Categorie($category_id ,$nom ,$description);
        $this->categorieModel->updateCategorie($categorie);
    }

    // trouver une categorie
    public function trouvercategorie($category_id){
        $id = $category_id;
        return $this->categorieModel->trouvercategorie($id);
    }

    // supprimer une categorie 
    public function deleteCategoryById($category_id){
        $id = $category_id;
        $this->categorieModel->supprimerCayegorie($id);
    }

}