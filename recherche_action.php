<?php include('session_check.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - Medicare</title>
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
        <h2>Résultats de recherche</h2>
        <?php
        // Connexion à la base de données
        $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

        // Vérification de la connexion
        if ($db_handle) {
            // Récupérer la requête de recherche
            $query = mysqli_real_escape_string($db_handle, $_GET['query']);

            // Requête SQL pour rechercher les médecins généralistes
            $sql_generalistes = "SELECT nom, prénom, bureau, mail, experience, photo, téléphone, 'Médecin Généraliste' AS spécialité 
                                 FROM medecing 
                                 WHERE nom LIKE '%$query%' OR prénom LIKE '%$query%'";
            
            // Requête SQL pour rechercher les médecins spécialistes
            $sql_specialistes = "SELECT nom, prénom, bureau, mail, experience, photo, téléphone, spécialité 
                                 FROM medecinspe 
                                 WHERE nom LIKE '%$query%' OR prénom LIKE '%$query%' OR spécialité LIKE '%$query%' OR établissement LIKE '%$query%'";
            
            // Requête SQL pour rechercher les laboratoires
            $sql_labo = "SELECT nom, bureau, mail, spécialité, photo, téléphone, consigne AS experience 
                        FROM labo 
                        WHERE nom LIKE '%$query%' OR spécialité LIKE '%$query%'";

            // Exécution des requêtes
            $result_generalistes = mysqli_query($db_handle, $sql_generalistes);
            $result_specialistes = mysqli_query($db_handle, $sql_specialistes);
            $result_labo = mysqli_query($db_handle, $sql_labo);

            // Fonction pour afficher les résultats
            function afficher_resultats($result, $type) {
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $photo = htmlspecialchars($row['photo']); 
                        echo "<div class='doctor-info'>";
                        echo "<div class='doctor-photo'><img src='medecin/" . $photo . "' alt='Photo du " . htmlspecialchars($type) . " " . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prénom']) . "'></div>";
                        echo "<div class='doctor-details'>";
                        echo "<p><strong>" . htmlspecialchars($row['spécialité']) . ":</strong> " . ($type === 'Laboratoire' ? '' : 'Dr ') . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prénom']) . "</p>";
                        echo "<p><strong>Bureau:</strong> " . htmlspecialchars($row['bureau']) . "</p>";
                        echo "<p><strong>Numéro de téléphone:</strong> " . htmlspecialchars($row['téléphone']) . "</p>";
                        echo "<p><strong>Email:</strong> " . htmlspecialchars($row['mail']) . "</p>";
                        echo "<p><strong>Expérience:</strong> " . htmlspecialchars($row['experience']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }

            // Affichage des résultats
            afficher_resultats($result_generalistes, 'Médecin Généraliste');
            afficher_resultats($result_specialistes, 'Médecin Spécialiste');
            afficher_resultats($result_labo, 'Laboratoire');

            if (mysqli_num_rows($result_generalistes) == 0 && mysqli_num_rows($result_specialistes) == 0 && mysqli_num_rows($result_labo) == 0) {
                echo "<p>Aucun résultat trouvé pour '<strong>" . htmlspecialchars($query) . "</strong>'.</p>";
            }
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