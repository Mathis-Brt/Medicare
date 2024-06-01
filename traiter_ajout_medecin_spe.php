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

// Récupérer le plus grand ID actuel dans la table medecinspe
$sql = "SELECT MAX(id) AS max_id FROM medecinspe";
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
$calendrier = mysqli_real_escape_string($conn, $_POST['calendrier']);
$photo = mysqli_real_escape_string($conn, $_POST['photo']);
$specialite = mysqli_real_escape_string($conn, $_POST['spécialité']);
$telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$formation = mysqli_real_escape_string($conn, $_POST['formation']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Insérer les données dans la table medecinspe
$sql = "INSERT INTO medecinspe (id, nom, prénom, bureau, mail, experience, calendrier, photo, spécialité, telephone, age, formation, password)
VALUES ('$new_id', '$nom', '$prenom', '$bureau', '$mail', '$experience', '$calendrier', '$photo', '$specialite', '$telephone', '$age', '$formation', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Nouveau médecin spécialiste ajouté avec succès";
    header("Location: ajouter_medecin.php");
    exit();
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
