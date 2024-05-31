<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Si l'utilisateur n'est pas connecté, afficher une alerte et le rediriger vers la page de connexion
    echo "<script>alert('Vous devez être connecté pour prendre un rendez-vous.'); window.location.href = 'Compte.html';</script>";
    exit();
}

// Vérifier si les données du formulaire sont présentes
if (isset($_POST['id_medecin'], $_POST['nom_client'], $_POST['date_heure'], $_POST['email_client'])) {
    // Récupérer les données du formulaire
    $id_medecin = $_POST['id_medecin'];
    $nom_client = $_POST['nom_client'];
    $date_heure = $_POST['date_heure'];
    $email_client = $_POST['email_client'];

    // Validation supplémentaire si nécessaire...
    
    // Ajouter le rendez-vous à la base de données ou effectuer toute autre opération nécessaire

    // Par exemple, si vous utilisez une base de données, vous pouvez insérer les données ainsi :
    // include 'connexion_bdd.php'; // Inclure le fichier de connexion à la base de données
    // $sql = "INSERT INTO rendez_vous (id_medecin, nom_client, agenda) VALUES (?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("iss", $id_medecin, $nom_client, $date_heure);
    // $stmt->execute();
    // $stmt->close();
    
    // Afficher une alerte pour confirmer le rendez-vous
    echo "<script>alert('Rendez-vous confirmé avec succès.'); window.location.href = 'accueil.php';</script>";
    exit();
} else {
    // Si les données du formulaire ne sont pas présentes, afficher une alerte et rediriger vers la page d'accueil
    echo "<script>alert('Une erreur s'est produite. Veuillez réessayer.'); window.location.href = 'accueil.php';</script>";
    exit();
}
?>
