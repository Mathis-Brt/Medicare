<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecins spécialistes - Tout parcourir - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .button-container a:nth-child(2) {
            background-color: lightblue; /* Changement de couleur du fond du bouton "Tout Parcourir" */
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
            <a href="Compte.php" class="button">Votre compte</a>
        </div>
    </nav>
    <main class="section">
        <h3 style="color: black;font-size:25px;font-weight: bold;" class="card-text">Voici la liste des différents services proposés par nos laboratoires : </h3>
        <?php
        // Connexion à la base de données
        $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

        // Vérification de la connexion
        if ($db_handle) {
            // Requête SQL pour récupérer les spécialités des médecins
            $sql = "SELECT DISTINCT spécialité FROM labo";
            $result = mysqli_query($db_handle, $sql);

            // Affichage des spécialités des médecins
            if ($result && mysqli_num_rows($result) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li><a href='";
                    if ($row['spécialité'] === "Dépistage covid-19") {
                        echo "labo_covid.php";
                    } elseif ($row['spécialité'] === "Biologie préventive") {
                        echo "labo_preventive.php";
                    } elseif ($row['spécialité'] === "Biologie de la femme enceinte") {
                        echo "labo_enceinte.php";
                    } elseif ($row['spécialité'] === "Biologie de routine") {
                        echo "labo_routine.php";
                    } elseif ($row['spécialité'] === "Cancérologie") {
                        echo "labo_cancerologie.php";
                    } elseif ($row['spécialité'] === "Gynécologie") {
                        echo "labo_gynecologie.php";
                    }
                    echo "'>" . htmlspecialchars($row['spécialité']) . "</a></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Aucune spécialité de médecin trouvée.</p>";
            }

            // Fermer la connexion
            mysqli_close($db_handle);
        } else {
            echo "<p>Erreur de connexion à la base de données.</p>";
        }
        ?>
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
