<?php
// Détruire la session
session_start();
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header("Location: Compte.html");
exit;
?>
