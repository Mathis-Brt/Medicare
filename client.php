<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecine générale - Espace Client - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .button-container a:nth-child(5) {
            background-color: lightblue; /* Changement de couleur du fond du bouton "Votre compte" */
        }

        .main-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .main-button-container a {
            margin: 0 10px;
            padding: 8px 15px;
            background-color: lightblue;
            color: black;
            text-align: center;
            text-decoration: none;
            font-size: 0.9em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .main-button-container a:hover {
            background-color: deepskyblue;
        }

        .title{
            text-align: center;
            margin-top: 40px;
            font-size: 1.5em; /* Taille de police plus grande */
            font-family: 'Copperplate Gothic Bold' ; /* Utilisation de la nouvelle police */
            text-decoration: underline; /* Souligner le texte */
        }
    </style>
</head>


<?php
// Placez cette partie du code avant la balise <header>
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

// Vous devriez avoir déjà récupéré les informations de l'utilisateur dans le fichier connexion.php
// Si oui, vous pouvez les stocker dans une session et les récupérer ici

// Fermer la connexion à la base de données
$conn->close();
?>






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
            <a href="accueil.html" class="button">Accueil</a>
            <a href="tout_parcourir.html" class="button">Tout Parcourir</a>
            <a href="recherche.html" class="button">Recherche</a>
            <a href="rdv.html" class="button">Rendez-vous</a>
            <a href="#" class="button">Votre compte</a>
        </div>
    </nav>

    <main class="section">
        <h2 class="title">Bienvenue sur votre espace personnel</h2>
        <div class="main-button-container">
            <!-- Boutons cachés en cas de connexion réussie -->
            <?php
            // Vérifier si l'utilisateur est connecté
            if ($result->num_rows > 0) {
                echo '<style>.main-button-container { display: none; }</style>';
                echo '<a href="deconnexion.php">Déconnexion</a>';
            } else {
                echo '<a href="#" onclick="openCreateAccountModal()">Créer un compte</a>';
                echo '<a href="#" onclick="openLoginModal()">Se connecter</a>';
            }
            ?>
        </div>
        <!-- Informations de l'utilisateur en cas de connexion réussie -->
        <?php
        if ($result->num_rows > 0) {
            // Affichez ici les informations de l'utilisateur récupérées de la base de données
            echo '<p>Nom : ' . $nom_utilisateur . '</p>';
            echo '<p>Prénom : ' . $prenom_utilisateur . '</p>';
            // Ajoutez le reste des informations de l'utilisateur ici...
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

    <!-- Modal de création de compte -->
    <div id="createAccountModal" class="modal">
        <!-- Modal de création de compte identique à Compte.html -->
    </div>

    <!-- Modal de connexion -->
    <div id="loginModal" class="modal">
        <!-- Modal de connexion identique à Compte.html -->
    </div>

</div>

<!-- JavaScript -->
<script>
    // Ajoutez votre JavaScript ici
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
