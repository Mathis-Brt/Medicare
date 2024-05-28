<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $carte_vitale = $_POST['carte_vitale'];
    $adresse_email = $_POST['adresse_email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $payment_type = $_POST['payment_type'];
    $card_number = $_POST['card_number'];
    $card_name = $_POST['card_name'];
    $date_expiration = '2024-06'; // Exemple de date d'expiration au format 'YYYY-MM'
    $date_expiration_formatted = $date_expiration . '-01'; // Ajout du jour '01' au format 'YYYY-MM-01'
    $security_code = $_POST['security_code'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "medecing";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifie la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Prépare et exécute la requête d'insertion
    $sql = "INSERT INTO client (prénom, nom, adresse, ville, cp, pays, telephone, cartevitale, mail, password, typepaiement, numerocarte, nomcarte, dateexpiration, codesecurité)
        VALUES ('$prenom', '$nom', '$adresse', '$ville', '$code_postal', '$pays', '$telephone', '$carte_vitale', '$adresse_email', '$mot_de_passe', '$payment_type', '$card_number', '$card_name', '$date_expiration_formatted', '$security_code')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Enregistrement réussi"); window.location.href = "accueil.html";</script>';
} else {
    echo '<script>alert("Échec de l\'enregistrement. Raison : '.$raison_echec.'"); window.location.href = "accueil.html";</script>';
}

    
    

    // Ferme la connexion
    $conn->close();
}
?>
