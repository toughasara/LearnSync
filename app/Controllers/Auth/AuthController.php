<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;

class AuthController{

    private UserModel $userModel;

    public function __construct()   {
        $this->userModel = new UserModel();
    }

    public function login($email, $password){

        $Utilisateur = $this->userModel->findUserByEmailAndPassword($email, $password);

        if($Utilisateur != null){
            $role = $Utilisateur->getRole();
            $id = $Utilisateur->getId();
            $status = $Utilisateur->getStatus();
            $deleted_at = $Utilisateur->getDeletedAt();
            
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["role"] = $role;
            $_SESSION["status"] = $status;
            $_SESSION["deleted_at"] = $deleted_at;

            if($_SESSION["role"] == "Administrateur"){
                header("Location:../Admin/index.php");
                exit();
            }
            else if($_SESSION["role"] == "enseignant" && $_SESSION["status"] == "active"){
                header("Location:../Enseignant/index.php");
            }
            else if($_SESSION["role"] == "etudiant" && $_SESSION["status"] == "active"){
                header("Location:../Etudiant/index.php");
            }
        }
        else{
            echo "user not found please check ...";
        }
    }


    public function Registre($nom, $email, $password, $type){

        $Utilisateur = $this->userModel->findUserByEmailAndPassword($email, $password);

        if($Utilisateur != null){
            echo "This email already exists.";
        }
        else{
            $hash = password_hash($password,PASSWORD_DEFAULT);
            if($type == "Administrateur"){
                $utilisateur = new Utilisateur( null, $nom, $email, $hash, $type, "inactive");
            }
            else{
                $utilisateur = new Utilisateur( null, $nom, $email, $hash, $type, "active");
                var_dump($utilisateur);
                exit;
            }
            $userModel->Registre($utilisateur);
            header("Location:../" . $role . "/home.php");
            exit();
        }
    }

}