<?php
session_start();

// Set up error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Display an alert if the user is not logged in and redirect to the login page
    echo '<script>alert("Vous devez être connecté pour confirmer un rendez-vous.");</script>';
    header("Location: Compte.html");
    exit();
}

// Check if form data is present
if (isset($_POST['id_medecin'], $_POST['jour'], $_POST['heure'])) {
    // Retrieve form data
    $id_medecin = $_POST['id_medecin'];
    $email_client = $_SESSION['email']; // Retrieve the email of the logged-in user
    $jour = $_POST['jour'];
    $heure = $_POST['heure'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "medecing";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the database connection
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Prepare the insertion query
    $sql = "INSERT INTO rendez_vous (medecin_id, email_client, jour, heure) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("isss", $id_medecin, $email_client, $jour, $heure);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the rendezvous page with a success message
        header("Location: rdv.php?message=Rendez-vous ajouté avec succès&success=true");
        exit();
    } else {
        // Display an error message if the insertion fails
        die("Erreur lors de l'insertion du rendez-vous : " . $stmt->error);
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If form data is not present, redirect to the home page
    header("Location: accueil.php");
    exit();
}
?>
