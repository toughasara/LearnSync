<?php

namespace App\Controllers\Auth;

use App\Classes\admin;
use App\Classes\Enseignant;
use App\Classes\Etudiant;
use App\Classes\Utilisateur;
use App\Classes\Role;
use App\Models\UserModel;
use PDO;

class AuthController{

    private UserModel $userModel;

    public function __construct()   {
        $this->userModel = new UserModel();
    }

    public function login($email, $password){

        $user = $this->userModel->findUserByEmailAndPassword($email, $password);

        if($user == null){
            echo "user not found please check ...";
        }
        else{
            if($user->getRole()->getTitle() == "Administrateur"){
                header("Location:../admin/statistique.php");
                exit();
            }
            else if($user->getRole()->getTitle() == "candidate"){
                header("Location:../candidate/index.php");
            }
            else if($user->getRole()->getTitle() == "recruiter"){
                header("Location:../recruiter/index.php");
            }
        }
    }

}