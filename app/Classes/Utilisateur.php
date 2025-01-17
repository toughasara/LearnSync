<?php

namespace App\Classes;

class Utilisateur{
    private $id;
    private $nom;
    private $email;
    private $password;
    private $role;
    private $status;
    private $created_at;
    private $deleted_at;

    public function __construct($id=null, $nom, $email, $password, $role, $status, $created_at= null, $deleted_at= null){
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }


    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRole(){
        return $this->role;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getCreatedAt(){
        return $this->created_at;
    }
    public function getDeletedAt(){
        return $this->deleted_at;
    }


    public function setId($id){
        $this->id = $id;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setRole($role){
        $this->role = $role;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }
    public function setDeletedAt($deleted_at){
        $this->deleted_at = $deleted_at;
    }
    
    
}