<?php

namespace App\Models\Enseignant;

use App\Classes\Course;
use App\Classes\Utilisateur;
use App\Classes\Inscription;
use App\Config\Database;
use PDO;

class InscriptionModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }
    
    // Récupérer les étudiants inscrits à un cours
    public function getInscriptionsByCourse($courseId) {
        $query = "SELECT 
                    i.id AS inscription_id,
                    i.enrollment_date,
                    u.id AS utilisateur_id,
                    u.nom AS utilisateur_nom,
                    u.email AS utilisateur_email
                FROM inscription i
                JOIN utilisateurs u ON i.utilisateur_id = u.id
                WHERE i.course_id = :courseId";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':courseId', $courseId, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $inscriptions = [];
        foreach ($results as $row) {
            $etudiant = new Utilisateur(
                $row['utilisateur_id'],
                $row['utilisateur_nom'],
                $row['utilisateur_email'],
                null,
                null,
                null,
                null,
                null
            );

            $inscriptions[] = new Inscription(
                $row['inscription_id'],
                null, // On ne récupère pas le cours ici
                $etudiant,
                $row['enrollment_date']
            );
        }

        return $inscriptions;
    }

    // Désinscrire un étudiant d'un cours
    public function desinscrireEtudiant($inscriptionId) {
        $query = "DELETE FROM inscription WHERE id = :inscriptionId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':inscriptionId', $inscriptionId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}