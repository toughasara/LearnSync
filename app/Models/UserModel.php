<?php
namespace App\Models;

use App\Classes\admin;
use App\Classes\Enseignant;
use App\Classes\Etudiant;
use App\Classes\Utilisateur;
use App\Classes\Role;
use App\Config\Database;
use PDO;

class UserModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }

    public function findUserByEmailAndPassword($email, $password){
        session_start();
        $query = "SELECT Utilisateur.id , Utilisateur.email , Utilisateur.password , Role.id as role_id , Role.titre as `role`
                FROM Utilisateur 
                join Role on Role.id = Utilisateur.role_id 
                where Utilisateur.email = :email";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$row || !password_verify($password, $row["password"])){
        return null;
        }
        else{
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];

            $role = new Role($row["role_id"], $row["role"]);
            return new Utilisateur($row['id'],$row["email"],$row["password"],$role);
        }
    }
}