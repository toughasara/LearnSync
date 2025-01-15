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
        // $admine->ajouterCategorie($categorie);

        $this->categorieModel->savecategorie($categorie);

    }

    // get tout les categories
    public function getCategories(){
        return $this->categorieModel->getAllCategories();
    }

    public function updateCategorie($category_id, $nom , $description){
        $categorie = new Categorie($category_id ,$nom ,$description);
        $this->categorieModel->updateCategorie($categorie);
    }

    // modification de categorie
    // public function updateCategorie($category_id, $nom , $description){
    //     // var_dump($category_id);
    //     // exit;
    //     $id = $category_id;

    //     $categorie = $admine->trouverCategorieParId($id);

    //     if ($categorie !== null) {
    //         $categorie->setNom($nom);
    //         $categorie->setDescription($description);
    //         return true;
    //     }
    //     return false;
    // }

    public function trouvercategorie($category_id){
        $id = $category_id;
        return $this->categorieModel->trouvercategorie($id);
    }

    // supprimer une categorie 
    public function deleteCategoryById($category_id){
        $id = $category_id;

        $this->categorieModel->supprimerCayegorie($id);

        // $categorieASupprimer = $admine->trouverCategorieParId($id);

        // $categories = $admine->getCategories();

        // if ($categorie !== null) {
        //     foreach ($this->categories as $index => $categorie) {
        //         if ($categorie === $categorieASupprimer) {
        //             unset($this->categories[$index]);
        //             $this->categories = array_values($this->categories);
        //             return true;
        //         }
        //     }
        //     return false; 
        // }
        // return false;
    }

}