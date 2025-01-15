<?php

namespace App\Controllers;
use App\Classes\Tag;
use App\Models\TagModel;

class TagController{

    private TagModel $tagModel;

    public function __construct()   {
        $this->tagModel = new TagModel();
    }

    // ajouter une tag
    public function addtag($noms){
        $nomArray = array_map('trim', explode(',', $noms));

        foreach ($nomArray as $nom) {
            $tag = new Tag(null, $nom);
            $this->tagModel->saveTag($tag);
        }
    }

    // get tout les tags
    public function getTags(){
        return $this->tagModel->getAllTags();
    }

    // modifier une tag
    public function updatetag($tag_id, $nom){
        $tag = new Tag($tag_id ,$nom);
        $this->tagModel->updateTag($tag);
    }

    // trouver une tag
    public function trouvertag($tag_id){
        $id = $tag_id;
        return $this->tagModel->trouvertag($id);
    }

    // supprimer une tag 
    public function deleteCategoryById($category_id){
        $id = $category_id;
        $this->tagModel->supprimerCayegorie($id);
    }
    

}