<?php
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

// Préparer la requête SQL avec une requête préparée pour éviter les injections SQL
$sql = "SELECT * FROM client WHERE mail = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si des données correspondantes sont trouvées dans la base de données
if ($result->num_rows > 0) {
    // Données de connexion correctes
    $row = $result->fetch_assoc(); // Récupérer toutes les données du client
    session_start();
    $_SESSION['email'] = $email;
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
} else {
    
    echo "Adresse e-mail ou mot de passe incorrect.";
    // Vous pouvez également ajouter un bouton pour retourner à la page de connexion
    echo '<a href="Compte.html">Retour à la page de connexion</a>';
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>
