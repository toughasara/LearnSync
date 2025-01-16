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
    private $utilisateur; 
    private $categorie;
    private $tags;
    private $createdAt;

    public function __construct($id = null, $title, $description, $contentType, $contentUrl, $utilisateur, $categorie, $tags = [], $createdAt = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->contentType = $contentType;
        $this->contentUrl = $contentUrl;
        $this->utilisateur = $utilisateur;
        $this->categorie = $categorie;
        $this->tags = $tags;
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

    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function getTags(){
        return  $this->tags;
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

    public function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }
}