<?php

namespace App\Controllers\Enseignant;
use App\Classes\Course;
use App\Classes\Utilisateur;
use App\Classes\Categorie;
use App\Models\Enseignant\CourseModel;

class CourseController{

    private $courseModel;

    public function __construct()   {
        $this->courseModel = new CourseModel();
    }

    public function addCourse($title, $description, $contentType, $contentUrl, $utilisateurId, $categorieId, $tags) {

        $utilisateur = new Utilisateur( $utilisateurId, null, null, null, null, null, null, null);
        $categorie = new Categorie( $categorieId, null, null);

        $course = new Course( null, $title, $description, $contentType, $contentUrl, $utilisateur, $categorie, [], null);

        $this->courseModel->addCourse($course, $tags);
    }

    // Récupérer tous les cours
    public function getAllCourses() {
        return $this->courseModel->getAllCourses();
    }

    // Supprimer un cours
    public function deleteCourse($courseId) {
        return $this->courseModel->deleteCourse($courseId);
    }


}