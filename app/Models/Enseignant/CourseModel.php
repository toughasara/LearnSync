<?php

namespace App\Models\Enseignant;

use App\Classes\Course;
use App\Classes\Utilisateur;
use App\Classes\Categorie;
use App\Classes\Tag;
use App\Config\Database;
use PDO;

class CourseModel{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection();
    }
    

    // Ajouter un cours
    public function addCourse($course, $tags) {
        $query = "INSERT INTO courses (title, description, content_type, content_url, utilisateur_id, category_id) 
                    VALUES (:title, :description, :contentType, :contentUrl, :utilisateurId, :categorieId)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $course->getTitle());
        $stmt->bindParam(':description', $course->getDescription());
        $stmt->bindParam(':contentType', $course->getContentType());
        $stmt->bindParam(':contentUrl', $course->getContentUrl());
        $stmt->bindParam(':utilisateurId', $course->getUtilisateur()->getId());
        $stmt->bindParam(':categorieId', $course->getCategorie()->getId());

        $stmt->execute();

        $courseId = $this->conn->lastInsertId();

        foreach ($tags as $tagId) {
            $query = "INSERT INTO course_tags (course_id, tag_id) 
                        VALUES (:courseId, :tagId)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':courseId', $courseId);
            $stmt->bindParam(':tagId', $tagId);
            $stmt->execute();
        }
    }

    // Récupérer tous les cours avec leurs tags
    // public function getAllCourses() {
    //     $query = "SELECT c.id AS course_id, c.title, c.description, c.content_type, c.content_url, cat.nom, t.nom
    //         FROM courses c
    //         JOIN categories cat ON c.category_id = cat.id
    //         LEFT JOIN course_tags ct ON c.id = ct.course_id
    //         LEFT JOIN tags t ON ct.tag_id = t.id
    //     ";

    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();

    //     $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     $courses = [];
    //     foreach ($courses as &$course) {
            
    //     }

    //     return $courses;
    // }
    public function getAllCourses() {
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
            JOIN utilisateurs u ON c.utilisateur_id = u.id
            JOIN categories cat ON c.category_id = cat.id
            LEFT JOIN course_tags ct ON c.id = ct.course_id
            LEFT JOIN tags t ON ct.tag_id = t.id
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $courses = [];
        foreach ($results as $row) {
            $courseId = $row['course_id'];
    
            if (!isset($courses[$courseId])) {
                // Créer un objet Utilisateur
                $utilisateur = new Utilisateur(
                    $row['utilisateur_id'],
                    $row['utilisateur_nom'],
                    null, // email
                    null, // password
                    null, // role
                    null, // status
                    null, // created_at
                    null  // deleted_at
                );
    
                // Créer un objet Categorie
                $categorie = new Categorie(
                    $row['categorie_id'],
                    $row['categorie_nom'],
                    $row['categorie_description']
                );
    
                // Créer un objet Course
                $courses[$courseId] = new Course(
                    $row['course_id'],
                    $row['title'],
                    $row['description'],
                    $row['content_type'],
                    $row['content_url'],
                    $utilisateur,
                    $categorie,
                    [], // tags (initialisé vide)
                    $row['created_at']
                );
            }
    
            // Ajouter le tag au cours s'il existe
            if ($row['tag_id'] !== null) {
                $tag = new Tag($row['tag_id'], $row['tag_nom']);
                $courses[$courseId]->setTags(array_merge($courses[$courseId]->getTags(), [$tag]));
            }
        }
    
        return array_values($courses); // Retourner un tableau indexé d'objets Course
    }

    // Supprimer un cours et ses tags
    public function deleteCourse($courseId) {
        $query = "DELETE FROM course_tags WHERE course_id = :courseId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();

        $query = "DELETE FROM courses WHERE id = :courseId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':courseId', $courseId);
        return $stmt->execute();
    }
    
}