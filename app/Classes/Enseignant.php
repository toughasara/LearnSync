<?php

namespace App\Classes;
use App\Classes\Utilisateur;

class Enseignant extends Utilisateur {

    public function __construct($id=null, $title, $nom, $email,  $password){
        $this->setId($id);
        $this->setTitle($title);
        $this->setNom($nom);
        $this->setEmail($email);
        $this->setPassword($password);
    }


}