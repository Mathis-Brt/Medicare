<?php
// Vérifier si l'ID et le type sont reçus
if(isset($_POST['id']) && isset($_POST['type'])) {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "medecing";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Préparer la requête de suppression en fonction du type
    $id = $_POST['id'];
    $type = $_POST['type'];
    $sql = "";

    if($type == "medecin") {
        $sql = "DELETE FROM medecing WHERE id = $id";
    } elseif($type == "specialiste") {
        $sql = "DELETE FROM medecinspe WHERE id = $id";
    } elseif($type == "laboratoire") {
        $sql = "DELETE FROM labo WHERE id = $id";
    }

    // Exécuter la requête de suppression
    if ($conn->query($sql) === TRUE) {
        echo "Suppression réussie";
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
} else {
    echo "ID ou type manquant";
}
?>
