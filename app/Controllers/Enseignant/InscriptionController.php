<?php

namespace App\Controllers\Enseignant;
use App\Classes\Course;
use App\Classes\Utilisateur;
use App\Classes\Inscription;
use App\Models\Enseignant\InscriptionModel;

class InscriptionController{

    private $inscriptionModel;

    public function __construct()   {
        $this->inscriptionModel = new InscriptionModel();
    }

    // Récupérer les étudiants inscrits à un cours
    public function getInscriptionsByCourse($courseId) {
        return $this->inscriptionModel->getInscriptionsByCourse($courseId);
    }

    // Désinscrire un étudiant d'un cours
    public function desinscrireEtudiant($inscriptionId) {
        return $this->inscriptionModel->desinscrireEtudiant($inscriptionId);
    }
    

}