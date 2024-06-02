<?php
// Connection à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "medecing";

// Créer la connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer le plus grand ID actuel dans la table labo
$sql = "SELECT MAX(id) AS max_id FROM labo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Récupérer le résultat
    $row = $result->fetch_assoc();
    $max_id = $row['max_id'];
    // Calculer le nouvel ID
    $new_id = $max_id + 1;
} else {
    // Si aucun enregistrement n'est trouvé, commencer à partir de 1
    $new_id = 1;
}

// Récupérer les données du formulaire et échapper les caractères spéciaux
$nom = mysqli_real_escape_string($conn, $_POST['nom']);
$bureau = mysqli_real_escape_string($conn, $_POST['bureau']);
$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$calendrier = mysqli_real_escape_string($conn, $_POST['calendrier']);
$photo = mysqli_real_escape_string($conn, $_POST['photo']);
$specialite = mysqli_real_escape_string($conn, $_POST['spécialité']);
$consigne = mysqli_real_escape_string($conn, $_POST['consigne']);
$telephone = mysqli_real_escape_string($conn, $_POST['telephone']);

// Insérer les données dans la table labo
$sql = "INSERT INTO labo (id, nom, bureau, mail, calendrier, photo, spécialité, consigne, telephone)
VALUES ('$new_id', '$nom', '$bureau', '$mail', '$calendrier', '$photo', '$specialite', '$consigne', '$telephone')";

if ($conn->query($sql) === TRUE) {
    echo "Nouveau laboratoire ajouté avec succès";
    header("Location:Compte.html");
    exit();
    echo "Nouveau laboratoire ajouté avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
