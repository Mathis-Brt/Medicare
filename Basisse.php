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
        .button-group {
            text-align: center;
            margin-top: 20px;
        }
        .button-group .btn {
            margin: 5px;
        }
        /* Style pour le chat */
        #chatBox {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            width: 300px;
            max-width: 100%;
            border: 1px solid #ccc;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: white;
            z-index: 1000;
        }
        #chatHeader {
            padding: 10px;
            background-color: rgb(32, 67, 104);
            color: white;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        #chatBody {
            padding: 10px;
            height: 200px;
            overflow-y: auto;
        }
        #chatFooter {
            padding: 10px;
            border-top: 1px solid #ccc;
            display: flex;
        }
        #chatFooter input {
            flex: 1;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #chatFooter button {
            margin-left: 5px;
            padding: 5px 10px;
            border: none;
            background-color: rgb(32, 67, 104);
            color: white;
            border-radius: 5px;
        }
        .chat-message {
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            background-color: #f1f1f1;
        }
        .chat-message.sent {
            text-align: right;
            background-color: #d4edda;
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
        <button class="btn btn-primary" onclick="window.location.href='prendre_rendezvous.php?id=1'">Prendre rendez-vous</button>
            <button class="btn btn-secondary" onclick="toggleChat()">Communiquer avec le médecin</button>
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

<div id="chatBox">
    <div id="chatHeader">
        Chat avec le médecin
        <button id="closeChatButton" onclick="toggleChat()" style="float: right; background: none; border: none; color: white; font-size: 20px; cursor: pointer;">&times;</button>
    </div>
    <div id="chatBody">
        <!-- Les messages seront affichés ici -->
    </div>
    <div id="chatFooter">
        <input type="text" id="chatInput" placeholder="Écrire un message...">
        <button onclick="sendMessage()">Envoyer</button>
        <!--<div id="notification" style="display: none; padding: 10px; background-color: #d4edda; text-align: center;">
            Message envoyé avec succès.-->
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleChat() {
    var chatBox = document.getElementById('chatBox');
    if (chatBox.style.display === 'none' || chatBox.style.display === '') {
        chatBox.style.display = 'block';
        loadMessages(); // Charger les messages lorsque le chat s'ouvre
    } else {
        chatBox.style.display = 'none';
    }
}

function loadMessages() {
    var medecing_id = 1;  // Id du médecin à remplacer dynamiquement
    var client_id = '12345';  // Id du client à remplacer dynamiquement
    $.ajax({
        url: 'fetch_messages.php',
        type: 'GET',
        data: { medecing_id: medecing_id, client_id: client_id },
        success: function(response) {
            var chatBody = document.getElementById('chatBody');
            chatBody.innerHTML = response;
            chatBody.scrollTop = chatBody.scrollHeight;
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Une erreur est survenue lors du chargement des messages.');
        }
    });
}

function sendMessage() {
    var chatInput = document.getElementById('chatInput');
    var message = chatInput.value;
    if (message.trim() !== "") {
        var medecing_id = 1;  // Id du médecin à remplacer dynamiquement
        var client_id = '12345';  // Id du client à remplacer dynamiquement
        var medecinspe_id = 2;  // Id du spécialiste à remplacer dynamiquement, si nécessaire
        $.ajax({
            url: 'send_message.php',
            type: 'POST',
            data: { message: message, medecing_id: medecing_id, client_id: client_id, medecinspe_id: medecinspe_id },
            success: function(response) {
                var chatBody = document.getElementById('chatBody');
                var newMessage = document.createElement('div');
                newMessage.textContent = message;
                newMessage.className = 'chat-message sent';
                chatBody.appendChild(newMessage);
                chatInput.value = "";
                chatBody.scrollTop = chatBody.scrollHeight;

                // Afficher la notification
                var notification = document.getElementById('notification');
                notification.style.display = 'block';
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 3000); // Disparaît après 3 secondes
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Une erreur est survenue lors de l\'envoi du message.');
            }
        });
    }
}

</script>
</body>
</html>