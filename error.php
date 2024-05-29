<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur de Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert-box {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #f5c6cb;
            background-color: #f8d7da;
            color: #721c24;
            width: 50%;
            text-align: center;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
    <script>
        function redirect() {
            alert("Adresse e-mail ou mot de passe incorrect.");
            window.location.href = 'Compte_html.php';
        }
        window.onload = redirect;
    </script>
</head>
<body>
    <div class="alert-box">
        <h2>Erreur de Connexion</h2>
        <p>Adresse e-mail ou mot de passe incorrect.</p>
    </div>
</body>
</html>
