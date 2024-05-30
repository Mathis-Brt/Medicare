<?php
// Vérification de l'existence du paramètre 'id'
if (!isset($_GET['id'])) {
    die("ID de médecin non spécifié.");
}

// Récupération de l'ID du médecin depuis l'URL
$id = intval($_GET['id']);

// Chargement du fichier XML
$xml = simplexml_load_file('medecins.xml');

// Recherche du médecin par ID
$medecin = null;
foreach ($xml->medecin as $m) {
    if (intval($m->id) === $id) {
        $medecin = $m;
        break;
    }
}

// Vérification si le médecin a été trouvé
if ($medecin === null) {
    die("Médecin non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.medicare.png" type="image/png">
    <title>CV du Médecin</title>
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

        .photo {
            text-align: center;
        }

        .photo img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
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
        <h2>CV du Médecin</h2>
        <div class="photo">
            <img src="<?php echo htmlspecialchars($medecin->photo); ?>" alt="Photo du Médecin">
        </div>
        <div class="info"><strong>Nom:</strong> <?php echo htmlspecialchars($medecin->nom); ?></div>
        <div class="info"><strong>Prénom:</strong> <?php echo htmlspecialchars($medecin->prénom); ?></div>
        <div class="info"><strong>Âge:</strong> <?php echo htmlspecialchars($medecin->age); ?></div>
        <div class="info"><strong>Formation:</strong> <?php echo htmlspecialchars($medecin->formation); ?></div>
        <div class="info"><strong>Expérience:</strong> <?php echo htmlspecialchars($medecin->experience); ?></div>
        <div class="info"><strong>Bureau:</strong> <?php echo htmlspecialchars($medecin->bureau); ?></div>
        <div class="info"><strong>Téléphone:</strong> <?php echo htmlspecialchars($medecin->telephone); ?></div>
        <div class="info"><strong>Email:</strong> <?php echo htmlspecialchars($medecin->mail); ?></div>
    </div>
</body>
</html>
