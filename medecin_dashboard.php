<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la variable de session
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

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

// Récupérer les informations de l'utilisateur connecté en fonction de son rôle
$email = $_SESSION['email'];
$role = $_SESSION['role'];

if ($role === 'admin') {
    $sql = "SELECT * FROM admin WHERE mail = ?";
} elseif ($role === 'client') {
    $sql = "SELECT * FROM client WHERE mail = ?";
} elseif ($role === 'medecin') {
    $sql = "SELECT * FROM medecinspe WHERE mail = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si des données correspondantes sont trouvées dans la base de données
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

    // Stocker les données de l'utilisateur dans des variables de session
    $_SESSION['nom'] = $user_data['nom'];
    $_SESSION['prenom'] = $user_data['prenom'];
    $_SESSION['adresse'] = $user_data['adresse'];
    $_SESSION['ville'] = $user_data['ville'];
    $_SESSION['cp'] = $user_data['cp'];
    $_SESSION['pays'] = $user_data['pays'];
    $_SESSION['telephone'] = $user_data['telephone'];
    if ($role === 'client') {
        $_SESSION['cartevitale'] = $user_data['cartevitale'] ?? '';
        $_SESSION['typepaiement'] = $user_data['typepaiement'] ?? '';
        $_SESSION['numerocarte'] = $user_data['numerocarte'] ?? '';
        $_SESSION['nomcarte'] = $user_data['nomcarte'] ?? '';
        $_SESSION['dateexpiration'] = $user_data['dateexpiration'] ?? '';
        $_SESSION['codesecurite'] = $user_data['codesecurite'] ?? '';
    }
} else {
    echo "Erreur : Utilisateur non trouvé.";
    exit();
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();

// Vous pouvez afficher d'autres informations de l'utilisateur ici

// Inclure votre HTML pour la page de compte
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .button-container a:nth-child(5) {
            background-color: lightblue;
        }

        .info-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 20px 0;
            width: 300px;
            color: black;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        .deconnexion-button {
            display: block;
            width: 20%;
            padding: 10px;
            text-align: center;
            background-color: red;
            color: white;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <header class="header">
        <div class="title-container">
            <h1 style="font-size: 50px;"><span>Medicare:</span> Services Médicaux</h1>
        </div>
        <img src="logo_medicare2.png" alt="Medicare Logo" class="logo">
        <img src="logo.png" alt="Logo Medicare" class="small-logo">
    </header>
    <nav class="navigation">
        <div class="button-container">
            <a href="accueil.php" class="button">Accueil</a>
            <a href="tout_parcourir.php" class="button">Tout Parcourir</a>
            <a href="recherche.php" class="button">Recherche</a>
            <a href="rdv.php" class="button">Rendez-vous</a>
            <?php if (isset($_SESSION['email'])): ?>
                <a href="compte.php" class="button">Votre compte</a>
            <?php else: ?>
                <a href="connexion.php" class="button">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="section">
        <h1>Bienvenue sur votre compte</h1>
        <div class="info-box">
            <p>Votre adresse e-mail : <?php echo htmlspecialchars($email); ?></p>
            <p>Role : <?php echo htmlspecialchars(ucfirst($role)); ?></p>
            <?php if ($role === 'client'): ?>
                <p>Nom : <?php echo htmlspecialchars($_SESSION['nom']); ?></p>
                <p>Prénom : <?php echo htmlspecialchars($_SESSION['prenom']); ?></p>
                <p>Adresse : <?php echo htmlspecialchars($_SESSION['adresse']); ?></p>
                <p>Ville : <?php echo htmlspecialchars($_SESSION['ville']); ?></p>
                <p>Code Postal : <?php echo htmlspecialchars($_SESSION['cp']); ?></p>
                <p>Pays : <?php echo htmlspecialchars($_SESSION['pays']); ?></p>
                <p>Téléphone : <?php echo htmlspecialchars($_SESSION['telephone']); ?></p>
                <p>Carte Vitale : <?php echo htmlspecialchars($_SESSION['cartevitale']); ?></p>
                <p>Type de Paiement : <?php echo htmlspecialchars($_SESSION['typepaiement']); ?></p>
                <p>Numéro de Carte : <?php echo htmlspecialchars($_SESSION['numerocarte']); ?></p>
                <p>Nom sur la Carte : <?php echo htmlspecialchars($_SESSION['nomcarte']); ?></p>
                <p>Date d'expiration : <?php echo htmlspecialchars($_SESSION['dateexpiration']); ?></p>
                <p>Code de Sécurité : <?php echo htmlspecialchars($_SESSION['codesecurite']); ?></p>
            <?php elseif ($role === 'medecin'): ?>
                <p>Nom : <?php echo htmlspecialchars($_SESSION['nom']); ?></p>
                <p>Spécialité : <?php echo htmlspecialchars($user_data['spécialité']); ?></p>
                <p>Téléphone : <?php echo htmlspecialchars($_SESSION['telephone']); ?></p>
            <?php endif; ?>
        </div>
        <a href="deconnexion.php" class="deconnexion-button">Déconnexion</a>
    </main>
    <footer class="footer">
        <div class="contact-info">
            <p>Téléphone: <a href="tel:+33 1 44 39 06 01">+33 1 44 39 06 01</a></p>
            <p>Adresse: 10 Rue Sextius Michel, Paris, 75015</p>
            <p>Email: <a href="mailto:omnes.medicare@gmail.com">omnes.medicare@gmail.com</a></p>
        </div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.6918020384956!2d2.2863122156753424!3d48.8512221792878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris%2C%20France!5e0!3m2!1sen!2sus!4v1623867849655!5m2!1sen!2sus" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
