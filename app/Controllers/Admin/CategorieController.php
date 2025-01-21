<?php

namespace App\Controllers\Admin;
use App\Classes\Categorie;
use App\Models\Admin\CategorieModel;

class CategorieController{

    private CategorieModel $categorieModel;

    public function __construct()   {
        $this->categorieModel = new CategorieModel();
    }

    // ajouter une categorie
    public function addcategorie($nom,$description){
        $categorie = new Categorie(null, $nom,$description);
        $this->categorieModel->create($categorie);
    }

    // get tout les categories
    public function getCategories(){
        return $this->categorieModel->getAll();
    }

    // modifier une categorie
    public function updateCategorie($category_id, $nom , $description){
        $categorie = new Categorie($category_id ,$nom ,$description);
        $this->categorieModel->update($categorie);
    }

    // trouver une categorie
    public function trouvercategorie($category_id){
        $id = $category_id;
        return $this->categorieModel->find($id);
    }

    // supprimer une categorie 
    public function deleteCategoryById($category_id){
        $id = $category_id;
        $this->categorieModel->delete($id);
    }

}