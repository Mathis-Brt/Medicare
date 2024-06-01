<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "medecing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

$response = ['success' => false, 'message' => 'Une erreur est survenue.'];

if (isset($_POST['id'])) {
    $id_rdv = $_POST['id'];

    $conn->begin_transaction();

    try {
        $sql = "SELECT medecin_id, jour, heure FROM rendez_vous WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erreur de préparation de la requête de sélection du rendez-vous : " . $conn->error);
        }
        $stmt->bind_param("i", $id_rdv);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            throw new Exception("Rendez-vous introuvable.");
        }
        $rdv = $result->fetch_assoc();
        $stmt->close();

        $sql = "DELETE FROM rendez_vous WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erreur de préparation de la requête de suppression de rendez-vous : " . $conn->error);
        }
        $stmt->bind_param("i", $id_rdv);
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la suppression du rendez-vous : " . $stmt->error);
        }
        $stmt->close();

        $sql = "INSERT INTO disponibilite (medecin_id, jour, heure) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erreur de préparation de la requête d'insertion de disponibilité : " . $conn->error);
        }
        $stmt->bind_param("iss", $rdv['medecin_id'], $rdv['jour'], $rdv['heure']);
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'insertion de la disponibilité : " . $stmt->error);
        }

        $conn->commit();
        $response = ['success' => true, 'message' => 'Rendez-vous annulé avec succès.'];

    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = $e->getMessage();
    }
}

$conn->close();
echo json_encode($response);
?>
