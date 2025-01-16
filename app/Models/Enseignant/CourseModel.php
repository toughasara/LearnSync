<?php

namespace App\Models\Enseignant;

use App\Classes\Course;
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
    public function getAllCourses() {
        $query = "SELECT c.id AS course_id, c.title, c.description, c.content_type, c.content_url, cat.nom
            FROM courses c
            JOIN categories cat ON c.category_id = cat.id
            LEFT JOIN course_tags ct ON c.id = ct.course_id
            LEFT JOIN tags t ON ct.tag_id = t.id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($courses as &$course) {
            
        }

        return $courses;
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