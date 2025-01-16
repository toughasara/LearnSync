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
        $stmt->bindParam(':utilisateurId', $course->getUtilisateurId());
        $stmt->bindParam(':categorieId', $course->getCategorieId());

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
    
}