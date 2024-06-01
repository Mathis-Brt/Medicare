<?php
session_start();

// Afficher toutes les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Si l'utilisateur n'est pas connecté, afficher une alerte et rediriger vers la page de connexion
    echo '<script>alert("Vous devez être connecté pour confirmer un rendez-vous.");</script>';
    header("Location: Compte.html");
    exit();
}

// Vérifier si les données du formulaire sont présentes
if (isset($_POST['id_medecin'], $_POST['nom_client'], $_POST['jour'], $_POST['heure'])) {
    // Récupérer les données du formulaire
    $id_medecin = $_POST['id_medecin'];
    $nom_client = $_POST['nom_client'];
    $jour = $_POST['jour'];
    $heure = $_POST['heure'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "medecing";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer la requête d'insertion
    $sql = "INSERT INTO rendez_vous (medecin_id, nom_client, jour, heure) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Binder les paramètres
    $stmt->bind_param("isss", $id_medecin, $nom_client, $jour, $heure);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'accueil avec un message de succès
        header("Location: rdv.php?message=Rendez-vous ajouté avec succès");
        exit();
    } else {
        die("Erreur lors de l'insertion du rendez-vous : " . $stmt->error);
    }

    // Fermer la requête préparée et la connexion
    $stmt->close();
    $conn->close();
} else {
    // Si les données du formulaire ne sont pas présentes, rediriger vers la page d'accueil
    header("Location: accueil.php");
    exit();
}
?>
