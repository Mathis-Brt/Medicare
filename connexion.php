<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "medecing";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérer les données du formulaire de connexion
$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

// Préparer la requête SQL pour les clients
$sql_client = "SELECT * FROM client WHERE mail = ? AND password = ?";
$stmt_client = $conn->prepare($sql_client);
$stmt_client->bind_param("ss", $email, $password);
$stmt_client->execute();
$result_client = $stmt_client->get_result();

// Préparer la requête SQL pour les admins
$sql_admin = "SELECT * FROM admin WHERE mail = ? AND password = ?";
$stmt_admin = $conn->prepare($sql_admin);
$stmt_admin->bind_param("ss", $email, $password);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();

// Préparer la requête SQL pour les médecins spécialistes
$sql_medecin = "SELECT * FROM medecinspe WHERE mail = ? AND password = ?";
$stmt_medecin = $conn->prepare($sql_medecin);
$stmt_medecin->bind_param("ss", $email, $password);
$stmt_medecin->execute();
$result_medecin = $stmt_medecin->get_result();

// Préparer la requête SQL pour les médecins généralistes
$sql_medecing = "SELECT * FROM medecing WHERE mail = ? AND password = ?";
$stmt_medecing = $conn->prepare($sql_medecing);
$stmt_medecing->bind_param("ss", $email, $password);
$stmt_medecing->execute();
$result_medecing = $stmt_medecing->get_result();

// Vérifier si des données correspondantes sont trouvées pour le client
if ($result_client->num_rows > 0) {
    $row = $result_client->fetch_assoc();
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'client';
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['prenom'] = $row['prenom'];
    $_SESSION['adresse'] = $row['adresse'];
    $_SESSION['ville'] = $row['ville'];
    $_SESSION['cp'] = $row['cp'];
    $_SESSION['pays'] = $row['pays'];
    $_SESSION['telephone'] = $row['telephone'];
    $_SESSION['cartevitale'] = $row['cartevitale'];
    $_SESSION['typepaiement'] = $row['typepaiement'];
    $_SESSION['numerocarte'] = $row['numerocarte'];
    $_SESSION['nomcarte'] = $row['nomcarte'];
    $_SESSION['dateexpiration'] = $row['dateexpiration'];
    $_SESSION['codesecurite'] = $row['codesecurite'];
    header("Location: compte.php");
    exit();
} elseif ($result_admin->num_rows > 0) {
    $row = $result_admin->fetch_assoc();
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'admin';
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['prenom'] = $row['prenom'];
    $_SESSION['adresse'] = $row['adresse'];
    $_SESSION['ville'] = $row['ville'];
    $_SESSION['cp'] = $row['cp'];
    $_SESSION['pays'] = $row['pays'];
    $_SESSION['telephone'] = $row['telephone'];
    header("Location: admin_dashboard.php");
    exit();
} elseif ($result_medecin->num_rows > 0) {
    $row = $result_medecin->fetch_assoc();
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'medecin';
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['prenom'] = $row['prenom'];
    $_SESSION['specialite'] = $row['specialite'];
    $_SESSION['adresse'] = $row['adresse'];
    $_SESSION['ville'] = $row['ville'];
    $_SESSION['cp'] = $row['cp'];
    $_SESSION['pays'] = $row['pays'];
    $_SESSION['telephone'] = $row['telephone'];
    header("Location: medecin_dashboard.php");
    exit();
} elseif ($result_medecing->num_rows > 0) {
    $row = $result_medecing->fetch_assoc();
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'medecing';
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['prenom'] = $row['prenom'];
    $_SESSION['specialite'] = $row['specialite'];
    $_SESSION['adresse'] = $row['adresse'];
    $_SESSION['ville'] = $row['ville'];
    $_SESSION['cp'] = $row['cp'];
    $_SESSION['pays'] = $row['pays'];
    $_SESSION['telephone'] = $row['telephone'];
    header("Location: medecing_dashboard.php");
    exit();
} else {
    echo "<script>alert('Adresse e-mail ou mot de passe incorrect.'); window.location.href = 'Compte.html';</script>";
}

// Fermer la connexion à la base de données
$stmt_client->close();
$stmt_admin->close();
$stmt_medecin->close();
$stmt_medecing->close();
$conn->close();
?>
