<?php
// Connexion à la base de données
$db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

// Vérification de la connexion
if ($db_handle) {
    // Récupérer les IDs de la requête
    $medecing_id = $_GET['medecing_id'];
    $client_id = $_GET['client_id'];

    // Requête SQL pour récupérer les messages
    $sql = "SELECT * FROM message WHERE medecing_id = ? AND client_id = ? ORDER BY id ASC";
    $stmt = mysqli_prepare($db_handle, $sql);
    mysqli_stmt_bind_param($stmt, 'is', $medecing_id, $client_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Affichage des messages
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $conversation = htmlspecialchars($row['conversation']);
            echo "<div class='chat-message'>";
            echo $conversation;
            echo "</div>";
        }
    } else {
        // Affichage du message par défaut si aucun message n'est trouvé
        echo "<div class='chat-message'>Bonjour, comment puis-je vous aider?</div>";
    }
} else {
    echo "<div class='chat-message'>Erreur de connexion à la base de données.</div>";
}
?>
