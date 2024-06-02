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


$sql = "SELECT MAX(id) AS max_id FROM admin";
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

$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Insérer les données dans la table medecinspe
$sql = "INSERT INTO admin (id,mail,password)
VALUES ('$new_id','$mail','$password')";

if ($conn->query($sql) === TRUE) {
    echo "Nouveau médecin spécialiste ajouté avec succès";
    header("Location: Compte.html");
    exit();
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
