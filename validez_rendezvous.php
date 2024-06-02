<?php
session_start();

// Afficher toutes les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Vous devez être connecté pour confirmer un rendez-vous.");</script>';
    header("Location: connexion.php");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "medecing";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Obtenir les informations du client
$email_client = $_SESSION['email'];
$stmt_client = $conn->prepare("SELECT nom, prenom, mail FROM client WHERE mail = ?");
$stmt_client->bind_param("s", $email_client);
$stmt_client->execute();
$result_client = $stmt_client->get_result();

if ($result_client->num_rows > 0) {
    $row_client = $result_client->fetch_assoc();
    $nom_client = $row_client['nom'];
    $prenom_client = $row_client['prenom'];
    $email_client = $row_client['mail'];
} else {
    echo '<script>alert("Client non trouvé.");</script>';
    header("Location: connexion.php");
    exit();
}
$stmt_client->close();

// Vérification des paramètres passés
if (isset($_POST['id_medecin']) && isset($_POST['jour']) && isset($_POST['heure']) && isset($_POST['nomcarte']) && isset($_POST['numerocarte']) && isset($_POST['codesecret'])) {
    $id_medecin = htmlspecialchars($_POST['id_medecin']);
    $jour = htmlspecialchars($_POST['jour']);
    $heure = htmlspecialchars($_POST['heure']);
    $nomcarte = htmlspecialchars($_POST['nomcarte']);
    $numerocarte = htmlspecialchars($_POST['numerocarte']);
    $codesecret = htmlspecialchars($_POST['codesecret']);

    // Obtenir les informations du médecin
    $stmt_medecin = $conn->prepare("SELECT nom, prénom, mail FROM medecing WHERE id = ?");
    $stmt_medecin->bind_param("i", $id_medecin);
    $stmt_medecin->execute();
    $result_medecin = $stmt_medecin->get_result();

    if ($result_medecin->num_rows > 0) {
        $row_medecin = $result_medecin->fetch_assoc();
        $nom_medecin = $row_medecin['nom'];
        $prenom_medecin = $row_medecin['prénom'];
        $email_medecin = $row_medecin['mail'];
    } else {
        echo '<script>alert("Médecin non trouvé.");</script>';
        header("Location: rdv.php");
        exit();
    }
    $stmt_medecin->close();

    // Préparation des informations pour l'email
    $to = $email_client;
    $subject = "Confirmation de votre rendez-vous";
    $message = "
    <html>
    <head>
        <title>Confirmation de rendez-vous</title>
    </head>
    <body>
        <p>Bonjour $prenom_client $nom_client,</p>
        <p>Votre rendez-vous est confirmé pour le <strong>$jour</strong> à <strong>$heure</strong> avec le médecin <strong>Dr. $prenom_medecin $nom_medecin</strong>.</p>
        <p>Cordialement,<br>Medicare Services Médicaux</p>
    </body>
    </html>
    ";
    $headers = "From: no-reply@medicare.com\r\n";
    $headers .= "Reply-To: no-reply@medicare.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoi de l'email
    if (mail($to, $subject, $message, $headers)) {
        echo '<script>alert("Rendez-vous confirmé et email envoyé."); window.location.href = "compte.php";</script>';
    } else {
        echo '<script>alert("Erreur lors de l\'envoi de l\'email."); window.location.href = "rdv.php";</script>';
    }

    // Redirection après confirmation
    exit();
} else {
    echo '<script>alert("Erreur lors de la confirmation du rendez-vous."); window.location.href = "rdv.php";</script>';
    exit();
}

$conn->close();
?>
