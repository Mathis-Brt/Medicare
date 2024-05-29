<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Afficher les informations de l'utilisateur
    echo 'Bienvenue, ' . $_SESSION['user']['nom'] . '! Vous êtes connecté.';
    // Afficher d'autres informations de l'utilisateur...
} else {
    // Afficher un message d'accueil général si l'utilisateur n'est pas connecté
    echo 'Bienvenue sur notre site!';
}
?>
