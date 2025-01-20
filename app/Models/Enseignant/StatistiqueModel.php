<?php

namespace App\Models\Enseignant;

use App\Config\Database;
use PDO;

class StatistiqueModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }

    // Récupérer le nombre total d'étudiants inscrits
    public function getTotalInscriptions($utilisateurId){
        $query = "SELECT COUNT(DISTINCT inscription.utilisateur_id) AS total_inscriptions
                FROM inscription
                JOIN courses ON inscription.course_id = courses.id
                WHERE courses.utilisateur_id = :utilisateurId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_inscriptions'];
    }

    // Récupérer le nombre total de cours
    public function getTotalCours($utilisateurId){
        $query = "SELECT COUNT(id) AS total_cours FROM courses WHERE utilisateur_id = :utilisateurId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_cours'];
    }

    // Récupérer le nombre d'étudiants inscrits par cours
    public function getInscriptionsParCours($utilisateurId){
        $query = "SELECT 
                    courses.id AS course_id,
                    courses.title AS course_title,
                    COUNT(inscription.utilisateur_id) AS nombre_inscriptions
                FROM courses
                LEFT JOIN inscription ON courses.id = inscription.course_id
                WHERE courses.utilisateur_id = :utilisateurId
                GROUP BY courses.id
                ORDER BY nombre_inscriptions DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}