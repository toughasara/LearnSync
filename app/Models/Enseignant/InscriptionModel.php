<?php

namespace App\Models\Enseignant;

use App\Classes\Course;
use App\Classes\Categorie;
use App\Classes\Tag;
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

     // inscription d'un etudiant a un course 
    public function inscrireEtudiant($courseId, $utilisateurId) {
        $query = "INSERT INTO inscription (course_id, utilisateur_id) 
                    VALUES (:courseId, :utilisateurId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':courseId', $courseId);
        $stmt->bindValue(':utilisateurId', $utilisateurId);
        return $stmt->execute();
    }

    // verifier l'inscription a un cours
    public function estInscrit($courseId, $utilisateurId) {
        $query = "SELECT * FROM inscription 
                    WHERE course_id = :courseId 
                    AND utilisateur_id = :utilisateurId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':courseId', $courseId);
        $stmt->bindValue(':utilisateurId', $utilisateurId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // les cours de l'inscription
    public function getCoursInscrits($utilisateurId) {
        try {
            $query = "SELECT 
                    c.id AS course_id,
                    c.title,
                    c.description,
                    c.content_type,
                    c.content_url,
                    c.created_at,
                    u.id AS utilisateur_id,
                    u.nom AS utilisateur_nom,
                    cat.id AS categorie_id,
                    cat.nom AS categorie_nom,
                    cat.description AS categorie_description,
                    t.id AS tag_id,
                    t.nom AS tag_nom
                FROM courses c
                JOIN inscription i ON c.id = i.course_id
                JOIN utilisateurs u ON c.utilisateur_id = u.id
                JOIN categories cat ON c.category_id = cat.id
                LEFT JOIN course_tags ct ON c.id = ct.course_id
                LEFT JOIN tags t ON ct.tag_id = t.id
                WHERE i.utilisateur_id = :utilisateurId
                ORDER BY c.id;";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
            $stmt->execute();
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $courses = [];
            foreach ($results as $row) {
                $courseId = $row['course_id'];
    
                if (!isset($courses[$courseId])) {
                    $utilisateur = new Utilisateur(
                        $row['utilisateur_id'],
                        $row['utilisateur_nom'],
                        null,
                        null,
                        null,
                        null,
                        null,
                        null 
                    );
    
                    $categorie = new Categorie(
                        $row['categorie_id'],
                        $row['categorie_nom'],
                        $row['categorie_description']
                    );
    
                    $courses[$courseId] = new Course(
                        $row['course_id'],
                        $row['title'],
                        $row['description'],
                        $row['content_type'],
                        $row['content_url'],
                        $utilisateur,
                        $categorie,
                        [], 
                        $row['created_at']
                    );
                }
    
                if ($row['tag_id'] !== null) {
                    $tag = new Tag($row['tag_id'], $row['tag_nom']);
                    $courses[$courseId]->setTags(array_merge($courses[$courseId]->getTags(), [$tag]));
                }
            }
    
            return array_values($courses);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des cours inscrits : " . $e->getMessage());
            return [];
        }
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