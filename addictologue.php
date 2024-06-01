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
            max-width: 200px;
            max-height: 200px;
        }
        .doctor-photo img {
        max-width: 200px;
        max-height: 200px;
        width: auto;
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
        .doctor-navigation-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(32, 67, 104); /* Couleur de fond pour contraster avec le texte blanc */
            padding: 10px;
        }
        .doctor-navigation {
            text-align: center;
            font-size: 30px; /* Augmenter la taille de la police */
            color: white; /* Changer la couleur de la police en blanc */
            flex: 1;
            display: flex;
            justify-content: center;
        }
        .doctor-specialty {
            font-size: 25px; /* Taille de la police pour la spécialité */
            color: black; /* Couleur de la police */
        }
        .back-button a {
            color: white;
            margin-left: 30px; /* Couleur du texte du bouton de retour */
        }
        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        .button-group button {
            margin: 0 5px; /* Réduire la marge entre les boutons */
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: rgb(32, 67, 104);
            color: white;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        #closeChatButton {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
        }
        #closeChatButton:hover {
            color: #ccc;
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
        .chat-message.saved {
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
    <nav class="navigation">
        <?php
        // Connexion à la base de données
        $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

        // Vérification de la connexion
        if ($db_handle) {
            // Requête SQL pour récupérer les informations des médecins addictologues
            $sql = "SELECT * FROM medecinspe WHERE spécialité = 'Addictologie'";
            $result = mysqli_query($db_handle, $sql);

            echo "<div class='doctor-navigation-container'>";
            echo "<div class='back-button'>";
            echo "<a href='medecins_specialistes.php' class='btn btn-primary'>Retour</a>";
            echo "</div>";

            // Affichage des informations
            if ($result && mysqli_num_rows($result) > 0) {
                echo "<div class='doctor-navigation'>";
                echo "<a href='#' style='color: white;'>Addictologie</a>";
                echo "</div>";
            } else {
                echo "<div class='doctor-navigation'>";
                echo "<p>Aucun résultat trouvé.</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Erreur de connexion à la base de données.</p>";
        }
        ?>
    </nav>
    <main class="section">
        <div class="doctor-container">
        <?php
            // Réinitialisation du pointeur de résultat
            mysqli_data_seek($result, 0);

            if ($result && mysqli_num_rows($result) > 0) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $photo = htmlspecialchars($row['photo']); // Assuming 'photo' is the column name for image path
                    echo "<div class='doctor-info'>";
                    // Affichage de l'image du médecin
                    echo "<img src='" . $photo . "' alt='Photo du Dr. " . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prénom']) . "' class='doctor-photo'>";
                    echo "<div class='doctor-details'>";
                    echo "<p><strong>Addictologue:</strong> Dr " . htmlspecialchars($row['nom']) . "</p>";
                    echo "<p><strong>Bureau:</strong> " . htmlspecialchars($row['bureau']) . "</p>";
                    echo "<p><strong>Numéro de téléphone:</strong> " . htmlspecialchars($row['telephone']) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($row['mail']) . "</p>";
                    echo "<p><strong>Expérience:</strong> " . htmlspecialchars($row['experience']) . "</p>";
                    echo "</div>";
                    echo "</div>";

                    if ($counter === 0) {
                        echo "<br>"; // Ajout d'une ligne vide
                        echo "<img src='medecin/planning_med7.png' alt='Planning' class='planning-image' width='900' height='100'>";
                    }
                                    
                    // Ajoutez une ligne vide avant le deuxième planning
                    if ($counter === 1) {
                        echo "<br>"; // Ajout d'une ligne vide
                        echo "<img src='medecin/planning_med8.png' alt='Planning médical' class='planning-image' width='900' height='100'>";
                    }

                    // Affichage des boutons sous le premier et le deuxième médecin
                    if ($counter < 2) {
                        echo "<div class='button-group'>";
                        echo "<button class='btn btn-primary' onclick=\"window.location.href='prendre_rendezvous.php'\">Prendre un rendez-vous</button>";
                        echo "<button class='btn btn-secondary' onclick=\"toggleChat()\">Communiquer avec le médecin</button>";
                        echo "<button class='btn btn-info' onclick=\"window.open('generate_cv.php?id=" . htmlspecialchars($row['id']) . "', '_blank')\">Voir son CV</button>";
                        echo "</div>";
                    }
                    $counter++;
                }
            }
            ?>
        </div>
    </main>
    <footer class="footer">
        <div class="contact-info">
            <p>Téléphone: <a href="tel:+33 1 44 39 06 01">+33 1 44 39 06 01</a></p>
            <p>AdreAsse: 10 Rue Sextius Michel, Paris, 75015</p>
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
    var storedMessages = loadMessagesFromLocalStorage(); // Charger les messages depuis le stockage local
    $.ajax({
        url: 'fetch_messages.php',
        type: 'GET',
        data: { medecing_id: medecing_id, client_id: client_id },
        success: function(response) {
            var chatBody = document.getElementById('chatBody');
            chatBody.innerHTML = response;
            chatBody.scrollTop = chatBody.scrollHeight;
            // Si des messages sont stockés localement, les ajouter à la fin
            storedMessages.forEach(function(message) {
                var newMessage = document.createElement('div');
                newMessage.textContent = message;
                newMessage.className = 'chat-message saved'; // Ajouter une classe spécifique aux messages sauvegardés
                chatBody.appendChild(newMessage);
            });
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
            var newMessage = document.createElement('div');
            newMessage.textContent = message;
            newMessage.className = 'chat-message sent';
            document.getElementById('chatBody').appendChild(newMessage);
            chatInput.value = "";

            // Sauvegarde le message dans le stockage local
            saveMessageToLocalStorage(message);
        }
    }

    function saveMessageToLocalStorage(message) {
        var storedMessages = loadMessagesFromLocalStorage();
        storedMessages.push(message);
        localStorage.setItem('chatMessages', JSON.stringify(storedMessages));
    }

    function loadMessagesFromLocalStorage() {
        var storedMessages = localStorage.getItem('chatMessages');
        return storedMessages ? JSON.parse(storedMessages) : [];
    }

    window.onload = function() {
        loadMessages();
    };
    
    // Supprimer le stockage local lorsque la page est fermée
    window.addEventListener('beforeunload', function() {
        localStorage.removeItem('chatMessages');
    });
</script>
</body>
</html>
