<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Identifier le nom de la base de données
$database = "medecing";

// Connectez-vous à la BDD
$db_handle = mysqli_connect('localhost', 'root', 'root');

if (!$db_handle) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Base de données non trouvée : " . mysqli_error($db_handle));
}

// Récupérer la spécialité de l'URL
$specialite = isset($_GET['specialite']) ? mysqli_real_escape_string($db_handle, $_GET['specialite']) : '';

if ($specialite) {
    // Utilisez les noms corrects des colonnes en fonction de votre base de données
    $sql = "
    SELECT nom, prénom, id FROM medecinspe WHERE spécialité = '$specialite'"; // Assurez-vous que la colonne existe dans medecing
    
    $result = mysqli_query($db_handle, $sql);

    if (!$result) {
        die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='doctor-list'>";
        echo "<h2>" . htmlspecialchars($specialite) . "</h2>";
        while ($data = mysqli_fetch_assoc($result)) {
            // Afficher les médecins
            echo "<div class='doctor'>";
            echo "<h2 style='color: black; font-size: 25px;'><a href='medecin" . htmlspecialchars($data['id']) . ".php'>" . htmlspecialchars($data['nom']) . " " . htmlspecialchars($data['prénom']) . "</a></h2>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "Aucun médecin trouvé pour cette spécialité.";
    }
} else {
    echo "Spécialité non spécifiée.";
}

// Fermer la connexion
mysqli_close($db_handle);
?>
