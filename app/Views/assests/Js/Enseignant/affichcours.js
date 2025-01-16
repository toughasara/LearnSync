// Fonctions pour modifier et supprimer les cours
function modifierCours(id) {
    console.log('Modifier cours:', id);
    // Ajoutez votre logique de modification
}

function supprimerCours(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
        console.log('Supprimer cours:', id);
        // Ajoutez votre logique de suppression
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Gestion des boutons de menu
    const menuButtons = document.querySelectorAll('.menu-btn');
    
    menuButtons.forEach(button => {
        button.addEventListener('click', function() {
            menuButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Gestion de la recherche
    const rechercheInput = document.getElementById('recherche-cours');
    rechercheInput.addEventListener('input', function() {
        // Ajoutez la logique de recherche en PHP
        window.location.href = '?search=' + encodeURIComponent(this.value);
    });

    // Gestion des filtres
    const filtreCategorie = document.getElementById('filtre-categorie');
    filtreCategorie.addEventListener('change', function() {
        // Ajoutez la logique de filtrage en PHP
        window.location.href = '?category=' + encodeURIComponent(this.value);
    });
});