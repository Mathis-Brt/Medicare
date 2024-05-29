<?php
session_start();

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}
?>
