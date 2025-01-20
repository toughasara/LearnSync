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

    // inscription d'un etudiant a un course 
    public function inscrireEtudiant($courseId, $utilisateurId) {
        return $this->inscriptionModel->inscrireEtudiant($courseId, $utilisateurId);
    }

    // verifier l'inscription a un cours
    public function estInscrit($courseId, $utilisateurId) {
        return $this->inscriptionModel->estInscrit($courseId, $utilisateurId);
    }

    // get les cours inscrie pour etudiant
    public function getCoursInscrits($utilisateurId) {
        return $this->inscriptionModel->getCoursInscrits($utilisateurId);
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