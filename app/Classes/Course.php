<?php

namespace App\Classes;

use App\Classes\Utilisateur;
use App\Classes\Categorie;

class Course {
    private $id;
    private $title;
    private $description;
    private $contentType;
    private $contentUrl;
    private $utilisateurId; 
    private $categorieId;
    private $createdAt;

    public function __construct($id = null, $title, $description, $contentType, $contentUrl, $utilisateurId, $categorieId, $createdAt = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->contentType = $contentType;
        $this->contentUrl = $contentUrl;
        $this->utilisateurId = $utilisateurId;
        $this->categorieId = $categorieId;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContentType() {
        return $this->contentType;
    }

    public function getContentUrl() {
        return $this->contentUrl;
    }

    public function getUtilisateurId() {
        return $this->utilisateurId;
    }

    public function getCategorieId() {
        return $this->categorieId;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }



    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContentType($contentType) {
        $this->contentType = $contentType;
    }

    public function setContentUrl($contentUrl) {
        $this->contentUrl = $contentUrl;
    }

    public function setUtilisateur($utilisateurId) {
        $this->utilisateurId = $utilisateurId;
    }

    public function setCategorie($categorieId) {
        $this->categorieId = $categorieId;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }
}