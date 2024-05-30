<?php
session_start(); // Démarrer la session
?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .button-container a:nth-child(1) {
            background-color: lightblue; /* Changement de couleur du fond du bouton "Tout Parcourir" */
        }
        .medicare-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column; /* Alignement vertical */
        }
        .medicare-container img {
            margin-bottom: 20px; /* Espace entre l'image et le texte */
            max-width: 350px; /* Largeur maximale de l'image */
            max-height: 350px; /* Hauteur maximale de l'image */
        }
        .text-container {
            text-align: justify;
            width:1000px;
        }
        .centered-title {
            text-align: center;
            margin-top: 40px;
            text-decoration: underline;
        }
        .centered-title2 {
            text-align: center;
            margin-top: 40px;
            font-size: 2em; /* Taille de police plus grande */
            font-family: 'Copperplate Gothic Bold' ; /* Utilisation de la nouvelle police */
            text-decoration: underline; /* Souligner le texte */
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
        <h2 style="color: black;" class="centered-title2">Bienvenue sur Medicare</h2><br>
        <div class="medicare-container">
            <div class="text-container">
                <p style="color: black; font-size: 18px;">Medicare est un groupe de services médicaux affilié à Omnes, dédié à fournir des soins de santé de haute qualité et des informations médicales fiables. Nos clients ont la possibilité de consulter en personne ou à distance des médecins généralistes ainsi que des médecins spécialistes dans plusieurs spécialités. De plus, nous offrons la possibilité de réaliser différents types de tests dans nos laboratoires de biologie. Grâce à une équipe de professionnels de santé expérimentés et à des technologies de pointe, Medicare s'engage à améliorer le bien-être de ses patients et à innover dans le domaine médical.</p>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="medecin/carroussel1.png" class="d-block w-100" alt="Med 1">
                    </div>
                    <div class="carousel-item">
                        <img src="medecin/carroussel2.png" class="d-block w-100" alt="Med 2">
                    </div>
                    <div class="carousel-item">
                        <img src="medecin/carroussel3.png" class="d-block w-100" alt="Med 3">
                    </div>
                    <div class="carousel-item">
                        <img src="medecin/carroussel4.png" class="d-block w-100" alt="Med 3">
                    </div>
                    <div class="carousel-item">
                        <img src="medecin/carroussel5.png" class="d-block w-100" alt="Med 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <h2 style="color: black;" class="centered-title">Bulletins santé de la semaine</h2><br>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="Medicare1.jpg" alt="Medicare 1" class="card-img-top img-thumbnail">
                        <div class="card-body">
                            <p style="color: black;font-size:small;font-weight: bold;" class="card-text"> Pour participer à la collecte, rendez-vous dans notre service de cancérologie du centre Medicare <a href="https://www.google.com/maps?ll=48.851225,2.288566&z=15&t=m&hl=en&gl=US&mapclient=embed&cid=1621113763460852342" target="_blank"> située ici.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="medecin/grippe.png" alt="Medicare 3" class="card-img-top img-thumbnail">
                        <div class="card-body">
                            <p style="color: black;font-size:small;font-weight: bold;" class="card-text"> Nouvelle épidémie de grippe : Consultez votre généraliste en cas de lourds symptômes. Si vous souhaitez consulter le profil de nos différents médecins généralistes, <a href="medecine_generale.php" target="_blank">cliquez-ici</a>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="Medicare2.jpg" alt="Medicare 2" class="card-img-top img-thumbnail">
                        <div class="card-body">
                            <p style="color: black;font-size:small;font-weight: bold;" class="card-text">Levée de fonds : Rénovation urgente de l'hôpital de Saint-Maures. Si vous souhaitez participer, <a href="https://www.helloasso.com/associations/france-nature-environnement-94/collectes/soutenons-la-lutte-pour-les-hopitaux-de-saint-maurice" target="_blank">cliquez-ici</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
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
