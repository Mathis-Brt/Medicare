<?php
// Connexion à la base de données
$db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

// Vérification de la connexion
if (!$db_handle) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérifier si l'ID du médecin est passé en paramètre
if(isset($_GET['doctor_id'])) {
    $doctor_id = $_GET['doctor_id'];

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
    <title>Prendre Rendez-vous - Medicare</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.medicare.png" type="image/png">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Prendre Rendez-vous</h1>
        <p>Disponibilités du médecin</p>
    </header>

    <main>
        <?php if (!empty($disponibilites)): ?>
            <h2>Disponibilités du Médecin</h2>
            <table class="table table-bordered">
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
            <p>Aucune disponibilité trouvée pour ce médecin.</p>
        <?php endif; ?>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
