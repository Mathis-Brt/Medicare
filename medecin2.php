<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docteur Medicare</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    // Connexion à la base de données
    $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

    // Vérification de la connexion
    if ($db_handle) {
        // Requête SQL pour récupérer les informations du Dr. Mathieu Basisse
        $sql = "SELECT * FROM medecing WHERE id = 2";
        $result = mysqli_query($db_handle, $sql);

        // Affichage des informations
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>Dr. " . $row['nom'] . " " . $row['prénom'] . "</h1>";
            echo "<p><strong>Bureau:</strong> " . $row['bureau'] . "</p>";
            echo "<p><strong>Email:</strong> " . $row['mail'] . "</p>";
            echo "<p><strong>Expérience:</strong> " . $row['experience'] . "</p>";
        } else {
            echo "Aucun résultat trouvé.";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($db_handle);
    } else {
        echo "Erreur de connexion à la base de données.";
    }
    ?>
</body>
</html>
