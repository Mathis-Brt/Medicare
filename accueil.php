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
        }
        .medicare-container img {
            margin-right: 20px; /* Espace entre l'image et le texte */
        }
        .text-container {
            flex: 1; /* Permet au conteneur de texte de prendre l'espace restant */
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
        <h2 style="color: black;" class="centered-title2">Bienvenue sur Medicare</h2><br><br>
        <div class="medicare-container">
            <img src="medicare_accueil.jpg" alt="Image Medicare Accueil" class="medicare-image">
            <div class="text-container">
                <p style="color: black; font-size: 18px;">Medicare est un groupe de services médicaux affilié à Omnes, dédié à fournir des soins de santé de haute qualité et des informations médicales fiables. Grâce à une équipe de professionnels de santé expérimentés et à des technologies de pointe, Medicare s'engage à améliorer le bien-être de ses patients et à innover dans le domaine médical.</p>
            </div>
        </div>
        <br><h2 style="color: black;" class="centered-title">Bulletin santé de la semaine</h2><br>



        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="Medicare1.jpg" alt="Medicare 1" class="card-img-top img-thumbnail" data-toggle="modal" data-target="#medicare1Modal">
                        <div class="card-body">
                            <p style="color: black;font-size:small;font-weight: bold;" class="card-text"> Lutte contre le cancer : récolte de cheveux. Trouvez le point de collecte le plus proche de chez vous.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="Medicare2.jpg" alt="Medicare 2" class="card-img-top img-thumbnail" data-toggle="modal" data-target="#medicare2Modal">
                        <div class="card-body">
                            <p style="color: black;font-size:small;font-weight: bold;" class="card-text">Levée de fonds : Rénovation urgente de l'hôpital de Saint-Maures.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="Medicare3.jpg" alt="Medicare 3" class="card-img-top img-thumbnail" data-toggle="modal" data-target="#medicare3Modal">
                        <div class="card-body">
                            <p style="color: black;font-size:small;font-weight: bold;" class="card-text"> Nouvelle épidémie de grippe : Consultez votre généraliste en cas de lourds symptômes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals for Medicare images -->
        <div class="modal fade" id="medicare1Modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="Medicare1.jpg" class="img-fluid" alt="Medicare 1">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="medicare2Modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="Medicare2.jpg" class="img-fluid" alt="Medicare 2">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="medicare3Modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="Medicare3.jpg" class="img-fluid" alt="Medicare 3">
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
