<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "utilisateur";
    $password = "mot_de_passe";
    $dbname = "medecing";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifie la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Prépare et exécute la requête de sélection
    $sql = "SELECT mot_de_passe FROM clients WHERE adresse_email='$loginEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Vérifie le mot de passe
        $row = $result->fetch_assoc();
        if (password_verify($loginPassword, $row['mot_de_passe'])) {
            echo "Connexion réussie";
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Adresse e-mail non trouvée";
    }

    // Ferme la connexion
    $conn->close();
}
?>
