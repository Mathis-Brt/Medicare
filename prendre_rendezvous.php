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
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Vérifier l'existence du paramètre 'id'
if (!isset($_GET['id'])) {
    die("ID de médecin non spécifié.");
}

// Récupérer l'ID du médecin depuis l'URL
$id = intval($_GET['id']);

// Vérifier si l'ID est compris entre 27 et 38
if ($id >= 27 && $id <= 38) {
    $table_name = 'labo'; // Utiliser la table "labo"
} else {
    $table_name = $id > 6 ? 'medecinspe' : 'medecing';
}

// Préparer et exécuter la requête pour obtenir les disponibilités
$sql = "SELECT disponibilite FROM $table_name WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Décoder les disponibilités depuis la chaîne JSON
    $disponibilites = json_decode($row['disponibilite'], true);
    // Vérifier si le décodage a réussi
    if ($disponibilites === null) {
        die("Erreur lors du décodage des disponibilités.");
    }
} else {
    die("Aucune disponibilité trouvée pour ce médecin.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <title>Disponibilités du Médecin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles CSS */
        body {
            font-size: 12px;
        }
        table {
            font-size: 12px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            padding: 4px;
            text-align: center;
            width: 20px; /* Largeur des colonnes */
        }
        h1.title {
            font-size: 40px;
            text-align: center;
        }
        .container {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
        .return-button {
            margin-top: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .navigation .button-container .button {
            font-size: 14px;
            padding: 10px 20px;
        }

        .dispo-D {
        color: green;
        font-weight: bold;
        }

        .dispo-I {
             color: red;
            font-weight: bold;
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
            <div class="container"><br>
            <h1 style="color: black;" class="title">Disponibilités du Médecin</h1><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Heure</th>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Heures possibles pour les rendez-vous
                        $heures_possibles = array('9h', '9h20', '9h40', '10h', '10h20', '10h40', '11h', '11h20', '11h40', '12h', '12h20', '12h40', '13h', '13h20', '13h40', '14h', '14h20', '14h40', '15h', '15h20', '15h40', '16h', '16h20', '16h40');

                        // Jours de la semaine
                        $jours = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

                        // Parcours des disponibilités
                        foreach ($heures_possibles as $heure) {
                            echo "<tr>";
                            echo "<td>$heure</td>";
                            foreach ($jours as $jour) {
                                echo "<td>";
                                if (isset($disponibilites[$jour][$heure])) {
                                    // Si la disponibilité est D, ajoute la classe dispo-D, sinon ajoute la classe dispo-I
                                    $classe_dispo = $disponibilites[$jour][$heure] ? 'dispo-D' : 'dispo-I';
                                    echo '<a href="confirmer_rendezvous.php?heure=' . urlencode($heure) . '&jour=' . urlencode($jour) . '&id_medecin=' . urlencode($id) . '" class="' . $classe_dispo . '">' . ($disponibilites[$jour][$heure] ? "D" : "I") . '</a>';
                                } else {
                                    echo '<span class="dispo-I">I</span>'; // Si la disponibilité n'est pas définie, affiche "I" en rouge
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        
                        ?>
                    </tbody>
                </table>

                <div class="legend">
        
        <p><span class="dispo-D">D</span> : Créneaux disponibles</p>
        <p><span class="dispo-I">I</span> : Créneaux indisponibles</p>
        </div> <br>
                <button class="btn btn-primary return-button" onclick="history.back()">Retour</button>
            </div>
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

