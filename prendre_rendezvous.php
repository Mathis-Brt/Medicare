<?php
// Connexion à la base de données
$db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

// Vérification de la connexion
if (!$db_handle) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérifier si l'ID du médecin est passé en paramètre
if(isset($_GET['id'])) {
    $doctor_id = intval($_GET['id']); // Sécurisation de l'entrée utilisateur

    // Requête SQL pour récupérer les disponibilités du médecin
    $sql = "SELECT date, time FROM disponibilites WHERE doctor_id = ?";
    $stmt = mysqli_prepare($db_handle, $sql);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Stocker les disponibilités dans un tableau
    $disponibilites = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $disponibilites[] = $row;
    }

    mysqli_stmt_close($stmt);
} else {
    die("ID du médecin non spécifié.");
}

mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <title>Disponibilités du Médecin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            text-align: center;
        }

        .container h2 {
            margin-top: 0;
        }

        .info {
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-group button {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>DisponibilitésA du Médecin</h2>
        <?php if (!empty($disponibilites)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($disponibilites as $dispo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dispo['date']); ?></td>
                            <td><?php echo htmlspecialchars($dispo['time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune disponibilité  trouvée pour ce médecin.</p>
        <?php endif; ?>
    </div>
</body>
</html>

