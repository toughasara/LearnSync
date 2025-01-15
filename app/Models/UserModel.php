<?php

namespace App\Models;

use App\Classes\Utilisateur;
use App\Config\Database;
use PDO;

class UserModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }

    public function findUserByEmailAndPassword($email, $password){
        $query = "SELECT *  FROM utilisateurs WHERE email = :email";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($password, $row["password"]);
        // exit;

        if (!$row || !password_verify($password, $row["password"])) {
            return null;
        } else {
            return new Utilisateur($row["id"],$row["nom"],$row["email"],$row["password"],$row["role"],$row["status"],$row["created_at"],$row["deleted_at"]);
        }
    }
    

    public function Registre($utilisateur){
        $nom = $utilisateur->getNom();
        $email = $utilisateur->getEmail();
        $password = $utilisateur->getPassword();
        $role = $utilisateur->getRole();
        $status = $utilisateur->getStatus();

        $query = "INSERT INTO user (nom, email, password, role, status) 
                VALUES (:nom, :email, :password, :role, :status);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
}