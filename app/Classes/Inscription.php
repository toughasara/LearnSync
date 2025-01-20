<?php

namespace App\Classes;

use App\Classes\Utilisateur;
use App\Classes\Course;

class Inscription {
    private $id;
    private $course;
    private $etudiant;
    private $dateInscription;

    public function __construct($id, $course, $etudiant, $dateInscription) {
        $this->id = $id;
        $this->course = $course;
        $this->etudiant = $etudiant;
        $this->dateInscription = $dateInscription;
    }

    public function getId() {
        return $this->id;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getEtudiant() {
        return $this->etudiant;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }
}