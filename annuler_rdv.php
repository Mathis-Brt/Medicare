<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    die("Vous devez être connecté pour annuler un rendez-vous.");
}

// Vérifier si l'ID du rendez-vous est fourni
if (!isset($_POST['id_rdv'])) {
    die("L'identifiant du rendez-vous n'est pas spécifié.");
}

$id_rdv = $_POST['id_rdv'];

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

// Requête SQL pour supprimer le rendez-vous
$sql = "DELETE FROM rendez_vous WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rdv);

if ($stmt->execute()) {
    echo "Rendez-vous annulé avec succès.";
} else {
    echo "Erreur lors de l'annulation du rendez-vous : " . $conn->error;
}

$stmt->close();
$conn->close();
?>
