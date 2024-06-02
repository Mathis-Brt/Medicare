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

// Vérification des paramètres passés
if (isset($_GET['heure']) && isset($_GET['jour']) && isset($_GET['id_medecin'])) {
    $heure = htmlspecialchars($_GET['heure']);
    $jour = htmlspecialchars($_GET['jour']);
    $id_medecin = htmlspecialchars($_GET['id_medecin']);

    // Déterminer si le médecin est un laboratoire
    if ($id_medecin >= 27 && $id_medecin <= 38) {
        $stmt = $conn->prepare("SELECT nom FROM labo WHERE id = ?");
    } else {
        if ($id_medecin >= 1 && $id_medecin <= 6) {
            $stmt = $conn->prepare("SELECT nom FROM medecing WHERE id = ?");
        } elseif ($id_medecin >= 7 && $id_medecin <= 14) {
            $stmt = $conn->prepare("SELECT nom FROM medecinspe WHERE id = ?");
        } else {
            $nom_medecin = "Médecin non trouvé";
            $stmt = null;
        }
    }

    if ($stmt) {
        $stmt->bind_param("i", $id_medecin);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nom_medecin = $row["nom"];
        } else {
            $nom_medecin = "Médecin non trouvé";
        }

        $stmt->close();
    }
} else {
    $heure = "";
    $jour = "";
    $id_medecin = "";
    $nom_medecin = "";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer Rendez-vous</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
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
            <h1>Confirmer Rendez-vous</h1>
            <p>Rendez-vous prévu pour le <?php echo $jour; ?> à <?php echo $heure; ?> avec le médecin <?php echo $nom_medecin; ?></p>

            <p> Veuillez rentrer vos informations bancaires pour confirmer le rendez-vous</p>

            <form action="valider_rendezvous.php" method="post">
                <input type="hidden" name="id_medecin" value="<?php echo $id_medecin; ?>">
                <input type="hidden" name="jour" value="<?php echo $jour; ?>">
                <input type="hidden" name="heure" value="<?php echo $heure; ?>">
            

                <label for="nomcarte">Nom sur la carte :</label>
                <input type="text" id="nomcarte" name="nomcarte" required>
                <br>

                <label for="numerocarte">Numéro de carte :</label>
                <input type="text" id="numerocarte" name="numerocarte" pattern="\d{16}" title="Le numéro de carte doit contenir 16 chiffres" required>
                <br>

                <label for="codesecret">Code de sécurité :</label>
                <input type="password" id="codesecret" name="codesecret" pattern="\d{3}" title="Le code de sécurité doit contenir 3 chiffres" required>
                <br>

                <button type="submit" class="confirm-button">Confirmer</button>
            </form>
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
</body>
</html>

<?php
$conn->close();
?>