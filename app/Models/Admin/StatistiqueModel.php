<?php

namespace App\Models\Admin;

use App\Config\Database;
use PDO;

class StatistiqueModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }

    // Nombre total de cours
    public function getTotalCours() {
        $query = "SELECT COUNT(*) as total FROM courses";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Répartition des cours par catégorie
    public function getRepartitionParCategorie() {
        $query = "SELECT c.nom, COUNT(courses.id) as total 
                FROM courses 
                JOIN categories c ON courses.category_id = c.id 
                GROUP BY c.nom";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cours avec le plus d'étudiants
    public function getCoursPlusPopulaire() {
        $query = "SELECT courses.title, COUNT(inscription.utilisateur_id) as total_etudiants 
                FROM inscription 
                JOIN courses ON inscription.course_id = courses.id 
                GROUP BY courses.id 
                ORDER BY total_etudiants DESC 
                LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Top 3 enseignants (par nombre d'étudiants inscrits à leurs cours)
    public function getTop3Enseignants() {
        $query = "SELECT u.nom, COUNT(inscription.utilisateur_id) as total_etudiants 
                FROM inscription 
                JOIN courses ON inscription.course_id = courses.id 
                JOIN utilisateurs u ON courses.utilisateur_id = u.id 
                WHERE u.role = 'enseignant' 
                GROUP BY u.id 
                ORDER BY total_etudiants DESC 
                LIMIT 3";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Nombre total d'étudiants
    public function getTotalEtudiants() {
        $query = "SELECT COUNT(*) as total FROM utilisateurs WHERE role = 'etudiant'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Nombre total d'enseignants
    public function getTotalEnseignants() {
        $query = "SELECT COUNT(*) as total FROM utilisateurs WHERE role = 'enseignant'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}