<?php

require_once("../../../vendor/autoload.php");
use App\Controllers\Auth\AuthController;



if(isset($_POST["submit"]))
{

    if(empty($_POST["nom"]) && empty($_POST["email"]) && empty($_POST["password"]))
    {
        echo "email or password is empty";
    }
    else{
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $type = $_POST["type"];

        $authController = new AuthController();
        $authController->Registre_condidat($nom, $email, $password, $type);

    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assests/Css/Auth/Registre.css">
</head>
<body>
    <div class="container">
        <div class="register-card">
            <div class="logo">
                <i class="fas fa-briefcase me-2"></i>Youdemy
            </div>
            <h4 class="text-center mb-4">Créer un compte</h4>
            
            <div class="user-type-selector">
                <a class="user-type-btn" id="studentBtn">
                    <i class="fas fa-user me-2"></i>Etudiant
                </a>
                <a class="user-type-btn active" id="teacherBtn">
                    <i class="fas fa-building me-2"></i>Enseignant
                </a>
            </div>

            <!-- Formulaire Enseignant -->
            <form id="teacherForm" method="POST" action="">
                <input type="text" class="form-control" name="nom" placeholder="Nom">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                <input hidden type="text" name="type" value="Enseignant">
                <input hidden type="password" name="submit" value="submit">

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="termsTeacher">
                    <label class="form-check-label" for="termsTeacher">
                        J'accepte les conditions d'utilisation et la politique de confidentialité
                    </label>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Créer mon compte</button>
            </form>

            <!-- Formulaire Étudiant -->
            <form id="studentForm" method="POST" action="">
                <input type="text" class="form-control" name="nom" placeholder="Nom">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                <input hidden type="text" name="type" value="Etudiant">
                <input hidden type="password" name="submit" value="submit">

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="termsStudent">
                    <label class="form-check-label" for="termsStudent">
                        J'accepte les conditions d'utilisation et la politique de confidentialité
                    </label>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Créer mon compte</button>
            </form>

            <div class="text-center mt-4">
                <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="../assests/Js/Auth/Registre.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>