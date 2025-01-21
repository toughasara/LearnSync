<?php

namespace App\Controllers\Admin;
use App\Classes\Tag;
use App\Models\Admin\TagModel;

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
            $this->tagModel->create($tag);
        }
    }

    // get tout les tags
    public function getTags(){
        return $this->tagModel->getAll();
    }

    // modifier une tag
    public function updateTag($tag_id, $nom){
        $tag = new Tag($tag_id ,$nom);
        $this->tagModel->update($tag);
    }

    // trouver une tag
    public function trouvertag($tag_id){
        $id = $tag_id;
        return $this->tagModel->find($id);
    }

    // supprimer une tag 
    public function deleteTagById($tag_id){
        $id = $tag_id;
        $this->tagModel->delete($id);
    }
    

}