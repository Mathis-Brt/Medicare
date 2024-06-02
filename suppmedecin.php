<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecine générale - Tout parcourir - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <style>
        .button-container a:nth-child(2) {
            background-color: lightblue; 
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
            <a href="compte.php" class="button">Votre compte</a>
        </div>
    </nav>
    <main class="section">
        <h3 style="color: black;font-size:25px;font-weight: bold;" class="card-text">Voici la liste de nos différents médecins et laboratoires : </h3>
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
            die("Connexion échouée : " . $conn->connect_error);
        }

        // Récupérer les médecins généralistes
        $sql_generalistes = "SELECT * FROM medecing";
        $result_generalistes = $conn->query($sql_generalistes);

        // Afficher les médecins généralistes
        if ($result_generalistes->num_rows > 0) {
            echo "<h4>Médecins généralistes :</h4>";
            while ($row_generalistes = $result_generalistes->fetch_assoc()) {
                echo "<p class='result' data-type='medecin' data-id='" . $row_generalistes['id'] . "'>" . $row_generalistes["nom"] . " " . $row_generalistes["prénom"] . "</p>";
            }
        }

        // Récupérer les médecins spécialistes
        $sql_specialistes = "SELECT * FROM medecinspe";
        $result_specialistes = $conn->query($sql_specialistes);

        // Afficher les médecins spécialistes
        if ($result_specialistes->num_rows > 0) {
            echo "<h4>Médecins spécialistes :</h4>";
            while ($row_specialistes = $result_specialistes->fetch_assoc()) {
                echo "<p class='result' data-type='medecin' data-id='" . $row_specialistes['id'] . "'>" . $row_specialistes["nom"] . " " . $row_specialistes["prénom"] . "</p>";
            }
        }

        // Récupérer les laboratoires
        $sql_labo = "SELECT * FROM labo";
        $result_labo = $conn->query($sql_labo);

        // Afficher les laboratoires
        if ($result_labo->num_rows > 0) {
            echo "<h4>Laboratoires :</h4>";
            while ($row_labo = $result_labo->fetch_assoc()) {
                echo "<p class='result' data-type='labo' data-id='" . $row_labo['id'] . "'>" . $row_labo["nom"] . "</p>";
            }
        }

        // Fermer la connexion à la base de données
        $conn->close();
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
<script>
    $(document).ready(function(){
        $(".result").click(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            var $element = $(this); // Stocker une référence à $(this)

            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {id: id, type: type},
                success: function(response){
                    // Effacer le nom de la page avec une transition
                    $element.fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                error: function(xhr, status, error){
                    console.error(xhr);
                    alert("Une erreur s'est produite lors de la suppression : " + error);
                }
            });
        });
    });
</script>

</body>
</html>

