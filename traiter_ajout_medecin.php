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

// Récupérer le plus grand ID actuel dans la table medecing
$sql = "SELECT MAX(id) AS max_id FROM medecing";
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
$prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
$bureau = mysqli_real_escape_string($conn, $_POST['bureau']);
$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$experience = mysqli_real_escape_string($conn, $_POST['experience']);
$formation = mysqli_real_escape_string($conn, $_POST['formation']);
$calendrier = mysqli_real_escape_string($conn, $_POST['calendrier']);
$photo = mysqli_real_escape_string($conn, $_POST['photo']);
$telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Insérer les données dans la table medecing
$sql = "INSERT INTO medecing (id, nom, prénom, bureau, mail, experience, formation, calendrier, photo, telephone, age, password)
VALUES ('$new_id', '$nom', '$prenom', '$bureau', '$mail', '$experience', '$formation', '$calendrier', '$photo', '$telephone', '$age', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Nouveau médecin ajouté avec succès";
    header("Location:Compte.html.php");
    exit();
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
