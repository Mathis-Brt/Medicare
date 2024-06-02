<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Médecin</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .info-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 20px 0;
            width: 300px;
            color: black;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        .upload-button {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            color: white;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            background-color: green;
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
                <a href="connexion.php" class="button">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="section">
    <h1>Creation Médecin/Specialistes/Labo</h1>
    <div class="info-box" style="display: inline-block; margin-right: 20px;">
        <h2>Je suis un Médecin Généraliste</h2>
        <form action="traiter_ajout_medecin.php" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="number" name="bureau" placeholder="Bureau" required>
            <input type="email" name="mail" placeholder="Email" required>
            <input type="text" name="experience" placeholder="Expérience" required>
            <input type="text" name="formation" placeholder="Formation" required>
            <input type="text" name="calendrier" placeholder="Calendrier" required>
            <input type="text" name="photo" placeholder="Photo" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <input type="number" name="age" placeholder="Âge" required>
            <input type="text" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Ajouter Médecin" class="upload-button">
        </form>
    </div>
    <div class="info-box" style="display: inline-block;">
        <h2>Je suis un Médecin Spécialiste</h2>
        <form action="traiter_ajout_medecin_spe.php" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="number" name="bureau" placeholder="Bureau" required>
            <input type="email" name="mail" placeholder="Email" required>
            <input type="text" name="experience" placeholder="Expérience" required>
            <input type="text" name="calendrier" placeholder="Calendrier" required>
            <input type="text" name="photo" placeholder="Photo" required>
            <select name="spécialité" required>
                <option value="">Choisissez une spécialité</option>
                <option value="Addictologie">Addictologie</option>
                <option value="Andrologie">Andrologie</option>
                <option value="Cardiologie">Cardiologie</option>
                <option value="Dermatologie">Dermatologie</option>
                <option value="Gastro-Hépato-Entérologie">Gastro-Hépato-Entérologie</option>
                <option value="Gynécologie">Gynécologie</option>
                <option value="I.S.T.">I.S.T.</option>
                <option value="Ostéopathie">Ostéopathie</option>
            </select>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <input type="number" name="age" placeholder="Âge" required>
            <input type="text" name="formation" placeholder="Formation" required>
            <input type="text" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Ajouter Médecin Spécialiste" class="upload-button">
        </form>
    </div>
    <div class="info-box" style="display: inline-block; margin-right: 20px;">
    <h2>Je suis un Laboratoire</h2>
    <form action="traiter_ajout_labo.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="number" name="bureau" placeholder="Bureau" required>
        <input type="email" name="mail" placeholder="Email" required>
        <input type="text" name="calendrier" placeholder="Calendrier" required>
        <input type="text" name="photo" placeholder="Photo" required>
        <input type="text" name="spécialité" placeholder="Spécialité" required>
        <input type="text" name="consigne" placeholder="Consigne" required>
        <input type="text" name="telephone" placeholder="Téléphone" required>
        <input type="submit" value="Ajouter Laboratoire" class="upload-button">
    </form>
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
