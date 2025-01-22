<?php

namespace App\Controllers\Auth;

use App\Classes\Utilisateur;
use App\Models\Auth\UserModel;

class AuthController{

    private UserModel $userModel;

    public function __construct()   {
        $this->userModel = new UserModel();
    }

    public function login($email, $password){

        $utilisateur = $this->userModel->findUserByEmailAndPassword($email);

        if ($utilisateur === null) {
            echo "Email pas trouver.";
            return;
        }

        if ($utilisateur->getDeletedAt() !== null) {
            echo "Ce compte a été supprimé.";
            return;
        }

        if ($utilisateur->getStatus() !== "active") {
            echo "Ce compte n'est pas actif.";
            return;
        }

        if (!password_verify($password, $utilisateur->getPassword())) {
            echo "mot de passe incorrect.";
            return;
        }

        $id = $utilisateur->getId();
        $role = $utilisateur->getRole();
        $status = $utilisateur->getStatus();
        $deleted_at = $utilisateur->getDeletedAt();
            
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["role"] = $role;
        $_SESSION["status"] = $status;
        $_SESSION["deleted_at"] = $deleted_at;

        if($_SESSION["role"] == "Administrateur"){
            header("Location:../Admin/index.php");
            exit();
        }
        else if($_SESSION["role"] == "enseignant"){
            header("Location:../Enseignant/index.php");
            exit();
        }
        else if($_SESSION["role"] == "etudiant"){
            header("Location:../Etudiant/index.php");
            exit();
        }
        
    }


    public function Registre($nom, $email, $password, $role){

        $Utilisateur = $this->userModel->findUserByEmailAndPassword($email, $password);

        if($Utilisateur != null){
            echo "This email already exists.";
        }
        else{
            $hash = password_hash($password,PASSWORD_DEFAULT);
            if($role == "Enseignant"){
                $utilisateur = new Utilisateur( null, $nom, $email, $hash, $role, "inactive");
            }
            else{
                $utilisateur = new Utilisateur( null, $nom, $email, $hash, $role, "active");
                // var_dump($utilisateur);
                // exit;
            }
            $this->userModel->Registre($utilisateur);
        }
    }

    public function logOut(){
        session_unset();
        session_destroy(); 
        header("Location: ../Auth/login.php");
        exit();
    }

}