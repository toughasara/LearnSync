<?php

namespace App\Controllers\Enseignant;

use App\Models\Enseignant\StatistiqueModel;

class StatistiqueController {
    private $statistiqueModel;

    public function __construct() {
        $this->statistiqueModel = new StatistiqueModel();
    }

    // le nombre total d'étudiants inscrits
    public function getTotalInscriptions($utilisateurId){
        return $this->statistiqueModel->getTotalInscriptions($utilisateurId);
    }

    // le nombre total de cours
    public function getTotalCours($utilisateurId){
        return $this->statistiqueModel->getTotalCours($utilisateurId);
    }

    // le nombre d'étudiants inscrits par cours
    public function getInscriptionsParCours($utilisateurId){
        return $this->statistiqueModel->getInscriptionsParCours($utilisateurId);
    }

}