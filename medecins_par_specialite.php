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
            font-size: 14px; 
            border: 1px solid #ccc; 
            padding: 20px; 
            border-radius: 10px;
            background-color: #f9f9f9; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .doctor-navigation {
            text-align: center;
            font-size: 30px;
            color: white; 
            background-color: rgb(32, 67, 104); 
        }
        .doctor-specialty {
            font-size: 25px; 
            color: black; 
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
        <?php
        // Connexion à la base de données
        $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

        if (!$db_handle) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }

        $db_found = mysqli_select_db($db_handle, $database);

        if (!$db_found) {
            die("Base de données non trouvée : " . mysqli_error($db_handle));
        }

        // Récupérer la spécialité de l'URL
        $specialite = isset($_GET['specialite']) ? mysqli_real_escape_string($db_handle, $_GET['specialite']) : '';

        if ($specialite) {
            // Utilisez les noms corrects des colonnes en fonction de votre base de données
            $sql = "SELECT nom, prénom, id FROM medecinspe WHERE spécialité = '$specialite'"; // Assurez-vous que la colonne existe dans medecing
            
            $result = mysqli_query($db_handle, $sql);

            if (!$result) {
                die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
            }

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='doctor-list'>";
                echo "<h2>" . htmlspecialchars($specialite) . "</h2>";
                while ($data = mysqli_fetch_assoc($result)) {
                    // Afficher les médecins
                    echo "<div class='doctor'>";
                    echo "<h2 style='color: black; font-size: 25px;'><a href='medecin" . htmlspecialchars($data['id']) . ".php'>" . htmlspecialchars($data['nom']) . " " . htmlspecialchars($data['prénom']) . "</a></h2>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Aucun médecin trouvé pour cette spécialité.";
            }
        } else {
            echo "Spécialité non spécifiée.";
        }

        // Fermer la connexion
        mysqli_close($db_handle);
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
                echo "<p><strong>Numéro de téléphone:</strong> Non défini</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['mail']) . "</p>";
                echo "<p><strong>Expérience:</strong> " . htmlspecialchars($row['experience']) . "</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
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

