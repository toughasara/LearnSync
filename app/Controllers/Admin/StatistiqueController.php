<?php

namespace App\Controllers\Admin;

use App\Models\Admin\StatistiqueModel;

class StatistiqueController {
    private $statistiqueModel;

    public function __construct() {
        $this->statistiqueModel = new StatistiqueModel();
    }

    // Nombre total de cours
    public function getTotalCours() {
        return $this->statistiqueModel->getTotalCours();
    }

    // Répartition des cours par catégorie
    public function getRepartitionParCategorie() {
        return $this->statistiqueModel->getRepartitionParCategorie();
    }

    // Cours avec le plus d'étudiants
    public function getCoursPlusPopulaire() {
        return $this->statistiqueModel->getCoursPlusPopulaire();
    }

    // Top 3 enseignants
    public function getTop3Enseignants() {
        return $this->statistiqueModel->getTop3Enseignants();
    }

    // Nombre total d'étudiants
    public function getTotalEtudiants() {
        return $this->statistiqueModel->getTotalEtudiants();
    }

    // Nombre total d'enseignants
    public function getTotalEnseignants() {
        return $this->statistiqueModel->getTotalEnseignants();
    }

}