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

// Si la BDD existe, faire le traitement
if ($db_found) {
    $sql = "
    SELECT DISTINCT spécialité AS specialite FROM medecinspe";
    
    $result = mysqli_query($db_handle, $sql);

    if (!$result) {
        die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='speciality-list'>";
        while ($data = mysqli_fetch_assoc($result)) {
            // Créer des liens vers les pages des spécialités
            echo "<div class='speciality'>";
            echo "<h2 style='color: black; font-size: 25px;'><a href='medecins_par_specialite.php?specialite=" . urlencode($data['specialite']) . "'>" . htmlspecialchars($data['specialite']) . "</a></h2>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "Aucune spécialité trouvée.";
    }
}

// Fermer la connexion
mysqli_close($db_handle);
?>
