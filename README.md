# LearnSync - Plateforme de Cours en Ligne

LearnSync est une plateforme de cours en ligne qui permet aux étudiants de suivre des cours interactifs et aux enseignants de créer et gérer leurs cours. Le projet est développé en PHP avec une base de données MySQL, en respectant les principes de la programmation orientée objet (OOP).

---

## Fonctionnalités

### Front Office
- **Visiteur** :
  - Accès au catalogue des cours avec pagination.
  - Recherche de cours par mots-clés.
  - Création de compte (étudiant ou enseignant).

- **Étudiant** :
  - Consultation des détails des cours (description, contenu, enseignant).
  - Inscription à un cours après authentification.
  - Accès à la section "Mes cours".

- **Enseignant** :
  - Ajout de nouveaux cours (titre, description, contenu, tags, catégorie).
  - Gestion des cours (modification, suppression, consultation des inscriptions).
  - Accès aux statistiques des cours (nombre d'étudiants inscrits, etc.).

### Back Office
- **Administrateur** :
  - Validation des comptes enseignants.
  - Gestion des utilisateurs (activation, suspension, suppression).
  - Gestion des contenus (cours, catégories, tags).
  - Statistiques globales (nombre total de cours, répartition par catégorie, etc.).

### Fonctionnalités Transversales
- Un cours peut contenir plusieurs tags (relation many-to-many).
- Système d’authentification et d’autorisation.
- Contrôle d’accès basé sur les rôles (étudiant, enseignant, admin).

---

## Technologies Utilisées

- **Backend** :
  - PHP (OOP, PDO, Sessions).
  - MySQL (Base de données relationnelle).
- **Frontend** :
  - HTML5, CSS3, JavaScript natif.
- **Sécurité** :
  - Validation des données côté client et serveur.
  - Protection contre les attaques XSS, CSRF et SQL Injection.
- **Outils** :
  - Git (Gestion de version).
  - Composer (Gestion des dépendances, si applicable).

---

## Installation

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/ton-username/youdemy.git
   cd youdemy
