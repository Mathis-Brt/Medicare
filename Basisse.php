<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecins spécialistes - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .doctor-info {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 20px;
        }
        .doctor-photo {
            margin-right: 20px;
        }
        .doctor-photo img {
            max-width: 200px;
            height: auto;
            border-radius: 10px;
        }
        .doctor-details {
            text-align: left;
            max-width: 600px;
            font-size: 14px; /* Réduire la taille de la police des détails */
            border: 1px solid #ccc; /* Bordure du rectangle */
            padding: 20px; /* Espacement interne du rectangle */
            border-radius: 10px; /* Coins arrondis du rectangle */
            background-color: #f9f9f9; /* Couleur de fond du rectangle */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Ombre du rectangle */
        }
        .doctor-navigation {
            text-align: center;
            font-size: 30px; /* Augmenter la taille de la police */
            color: white; /* Changer la couleur de la police en blanc */
            background-color: rgb(32, 67, 104); /* Couleur de fond pour contraster avec le texte blanc */
        }
        .doctor-specialty {
            font-size: 25px; /* Taille de la police pour la spécialité */
            color: black; /* Couleur de la police */
        }
        .button-group {
            text-align: center;
            margin-top: 20px;
        }
        .button-group .btn {
            margin: 5px;
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
    <nav class="navigation" style="display: flex; align-items: center;">
    <?php
    // Connexion à la base de données
    $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

    // Vérification de la connexion
    if ($db_handle) {
        // Requête SQL pour récupérer les informations du médecin avec id = 1
        $sql = "SELECT * FROM medecing WHERE id = 1";
        $result = mysqli_query($db_handle, $sql);

        // Affichage des informations
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Bouton de retour
            echo "<div class='back-button' style='margin-left: 30px;'>";
            echo "<a href='medecine_generale.php' class='btn btn-primary'>Retour</a>";
            echo "</div>";

            echo "<div class='doctor-navigation' style='margin-left: auto; margin-right: auto;'>";
            echo "<p>Dr. " . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prénom']) . "</p>";
            //echo "<img src='" . $row['photo'] . "' height='80' width='100'>";
            echo "</div>";
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }
    } else {
        echo "<p>Erreur de connexion à la base de données.</p>";
    }
    ?>
    </nav>
    <main class="section">
        <div class="doctor-container">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                echo "<div class='doctor-info'>";
                echo "<div class='doctor-photo'><img src='medecin/medecinh.jpg' alt='Photo du Dr. " . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prénom']) . "'></div>";
                echo "<div class='doctor-details'>";
                echo "<p><strong>Médecin généraliste</strong></p>";
                echo "<p><strong>Bureau:</strong> " . htmlspecialchars($row['bureau']) . "</p>";
                echo "<p><strong>Numéro de téléphone:</strong> " . htmlspecialchars($row['telephone']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['mail']) . "</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <br>
        <img src="medecin/planning_med1.png" alt="Planning medecin" width="900" height="110">
        <div class="button-group">
            <button class="btn btn-primary" onclick="window.open('prendre_rendezvous.php?id=1')">Prendre rendez-vous</button>
        
        
            <button class="btn btn-secondary" onclick="window.location.href='communiquer_medecin.php'">Communiquer avec le médecin</button>
            <button class="btn btn-info" onclick="window.open('generate_cv.php?id=1', '_blank')">Voir son CV</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
