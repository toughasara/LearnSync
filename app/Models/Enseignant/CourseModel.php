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

    //get all courses
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
    }

    //trouver un course 
    public function trouvercourse($id){
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
                where c.id = :id
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if($row) {
            $courseData = $rows[0];
            $utilisateur = new Utilisateur(
                $courseData['utilisateur_id'],
                $courseData['utilisateur_nom'],
                null,
                null,
                null,
                null,
                null,
                null
            );
    
            $categorie = new Categorie(
                $courseData['categorie_id'],
                $courseData['categorie_nom'],
                $courseData['categorie_description']
            );
    
            $course = new Course(
                $courseData['course_id'],
                $courseData['title'],
                $courseData['description'],
                $courseData['content_type'],
                $courseData['content_url'],
                $utilisateur,
                $categorie,
                [],
                $courseData['created_at']
            );
    
            foreach ($rows as $row) {
                if ($row['tag_id'] !== null) {
                    $tag = new Tag($row['tag_id'], $row['tag_nom']);
                    $course->setTags(array_merge($course->getTags(), [$tag]));
                }
            }
    
            return $course;
        }
        else {
            return null;
        }
    
    }

    // modifier un course et ses tags 
    public function updatecourse($course, $tags){
        $query = "UPDATE courses 
                    SET title = :title
                    SET description = :description
                    SET content_type = :contentType
                    SET content_url = :contentUrl
                    SET utilisateur_id = :utilisateurId
                    SET category_id = :categorieId
                    WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $course->getTitle());
        $stmt->bindParam(':description', $course->getDescription());
        $stmt->bindParam(':contentType', $course->getContentType());
        $stmt->bindParam(':contentUrl', $course->getContentUrl());
        $stmt->bindParam(':utilisateurId', $course->getUtilisateur()->getId());
        $stmt->bindParam(':categorieId', $course->getCategorie()->getId());
        $stmt->bindParam(':id', $course->getId());

        $stmt->execute();

        $courseId = $this->conn->lastInsertId();

        $query = "DELETE FROM courses WHERE id = :courseId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':courseId', $course->getId());
        $stmt->execute();

        foreach ($tags as $tagId) {
            $query = "INSERT INTO course_tags (course_id, tag_id) 
                        VALUES (:courseId, :tagId)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':courseId', $course->getId());
            $stmt->bindParam(':tagId', $tagId);
            $stmt->execute();
        }
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
        $stmt->execute();
    }
    
}