<?php
session_start();

// Afficher toutes les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$rendez_vous = [];
$is_logged_in = isset($_SESSION['email']);

if ($is_logged_in) {
    // Récupérer les rendez-vous de l'utilisateur connecté
    $email_client = $_SESSION['email'];
    $sql = "SELECT r.jour, r.heure, m.nom AS nom_medecin FROM rendez_vous r JOIN medecing m ON r.medecin_id = m.id WHERE r.email_client = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_client);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rendez_vous[] = $row;
        }
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .button-container a:nth-child(4) {
            background-color: lightblue;
        }
        table th, table td {
            font-size: 14px; /* Taille de police réduite */
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
                <a href="Compte.html" class="button">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="section">
        <h1>Vos Rendez-vous</h1>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="alert alert-success" role="alert">
                Rendez-vous ajouté avec succès !
            </div>
        <?php endif; ?>

        <?php if ($is_logged_in): ?>
            <?php if (!empty($rendez_vous)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Médecin</th>
                            <th>Jour</th>
                            <th>Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rendez_vous as $rdv): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rdv['nom_medecin']); ?></td>
                                <td><?php echo htmlspecialchars($rdv['jour']); ?></td>
                                <td><?php echo htmlspecialchars($rdv['heure']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun rendez-vous à afficher.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Connectez-vous pour voir vos rendez-vous.</p>
        <?php endif; ?>
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
