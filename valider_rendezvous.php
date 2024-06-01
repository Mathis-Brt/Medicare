<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: Compte.html");
    exit();
}

// Vérifier si les données du formulaire sont présentes
if (isset($_POST['id_medecin'], $_POST['nom_client'], $_POST['date_heure'], $_POST['email_client'])) {
    // Récupérer les données du formulaire
    $id_medecin = $_POST['id_medecin'];
    $nom_client = $_POST['nom_client'];
    $date_heure = $_POST['date_heure'];
    $email_client = $_POST['email_client'];

    // Ajouter le rendez-vous à la base de données
    include 'connexion_bdd.php'; // Inclure le fichier de connexion à la base de données
    $sql = "INSERT INTO rendez_vous (id_medecin, nom_client, agenda) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_medecin, $nom_client, $date_heure);
    $stmt->execute();
    $stmt->close();

    // Rediriger vers la page d'accueil
    header("Location: accueil.php");
    exit();
} else {
    // Si les données du formulaire ne sont pas présentes, rediriger vers la page d'accueil
    header("Location: accueil.php");
    exit();
}
?>
