<?php
// Vérification si le message est envoyé via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['client_id']) && isset($_POST['medecin_id'])) {
    // Récupération des données envoyées depuis la requête AJAX
    $message = $_POST['message'];
    $client_id = $_POST['client_id'];
    $medecin_id = $_POST['medecin_id'];

    // Connexion à la base de données
    $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

    // Vérification de la connexion
    if ($db_handle) {
        // Préparation de la requête d'insertion du message dans la table message
        $sql = "INSERT INTO message (medecing_id, medecinspe_id, client_id, conversation) VALUES (?, ?, ?, ?)";
        
        // Préparation de la requête avec une déclaration préparée
        if ($stmt = mysqli_prepare($db_handle, $sql)) {
            // Liaison des paramètres à la déclaration préparée
            mysqli_stmt_bind_param($stmt, "iiss", $medecin_id, $medecin_id, $client_id, $message);
            
            // Exécution de la déclaration préparée
            if (mysqli_stmt_execute($stmt)) {
                // Réponse envoyée au client si l'insertion est réussie
                echo "Message envoyé avec succès.";
            } else {
                // Réponse envoyée au client en cas d'échec de l'insertion
                echo "Erreur lors de l'envoi du message à la base de données.";
            }

            // Fermeture de la déclaration préparée
            mysqli_stmt_close($stmt);
        } else {
            // Réponse envoyée au client en cas d'échec de préparation de la requête
            echo "Erreur lors de la préparation de la requête d'insertion.";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($db_handle);
    } else {
        // Réponse envoyée au client en cas d'erreur de connexion à la base de données
        echo "Erreur de connexion à la base de données.";
    }
} else {
    // Réponse envoyée au client si le message n'est pas envoyé via la méthode POST
    echo "Aucun message reçu.";
}
?>