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

    //get all courses of a user
    public function getAllCoursesutil($utilisateurId){
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
        WHERE (:utilisateurId IS NULL OR c.utilisateur_id = :utilisateurId)
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
            ORDER BY c.id;";
            
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($results);
        // exit;
    
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
    
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if($rows) {
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
        try {
            $this->conn->beginTransaction();
                $query = "UPDATE courses 
                            SET title = :title,
                            description = :description,
                            content_type = :contentType,
                            content_url = :contentUrl,
                            utilisateur_id = :utilisateurId,
                            category_id = :categorieId
                            WHERE id = :id";
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue(':title', $course->getTitle());
                $stmt->bindValue(':description', $course->getDescription());
                $stmt->bindValue(':contentType', $course->getContentType());
                $stmt->bindValue(':contentUrl', $course->getContentUrl());
                $stmt->bindValue(':utilisateurId', $course->getUtilisateur()->getId());
                $stmt->bindValue(':categorieId', $course->getCategorie()->getId());
                $stmt->bindValue(':id', $course->getId());

                $stmt->execute();

                $courseId = $course->getId();
                

                $query = "DELETE FROM course_tags WHERE course_id = :courseId";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':courseId', $course->getId());
                $stmt->execute();

                foreach ($tags as $tagId) {
                    $query = "SELECT id FROM tags WHERE id = :tagId";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindValue(':tagId', $tagId);
                    $stmt->execute();

                    if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
                        throw new Exception("Le tag avec l'ID " . $tagId . " n'existe pas.");
                    }

                    $query = "INSERT INTO course_tags (course_id, tag_id) 
                                VALUES (:courseId, :tagId)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindValue(':courseId', $course->getId());
                    $stmt->bindValue(':tagId', $tagId);
                    $stmt->execute();
                }
                $this->conn->commit();
            } catch (Exception $e) {
                $this->conn->rollBack();
                throw $e;
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

    // inscription d'un etudiant a un course 
    public function inscrireEtudiant($courseId, $utilisateurId) {
        $query = "INSERT INTO inscription (course_id, utilisateur_id) 
                    VALUES (:courseId, :utilisateurId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':courseId', $courseId);
        $stmt->bindValue(':utilisateurId', $utilisateurId);
        return $stmt->execute();
    }

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
    
}