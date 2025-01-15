<?php

namespace App\Classes;

class Tag {
    public $id;
    private $nom;
    
    public function __construct($id=null, $nom) {
            $this->id = $id;
            $this->nom = $nom;
    }

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }


    public function setNom($nom) {
        $this->nom = $nom;
    }

}