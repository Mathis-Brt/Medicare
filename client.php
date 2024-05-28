<?php

//identifier le nom de base de données
$database = "client";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', 'root' );

$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement
if ($db_found) {
    $sql = "SELECT * FROM client";
    $result = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($result)) {
        echo "Nom:" . $data['nom'] . "<br>";
        echo "Prénom: " . $data['prénom'] . "<br>";
        echo "Adresse: " . $data['adresse'] . "<br>";
        echo "Ville: " . $data['ville'] . "<br>";
        echo "Code postale: " . $data['cp'] . "<br>";
        echo "Pays: " . $data['pays'] . "<br>";
        echo "Telephone: " . $data['telephone'] . "<br>";
        echo "Carte Vitale: " . $data['cartevitale'] . "<br>";
        echo "Type de paiement: " . $data['typepaiement'] . "<br>";
        echo "Nulero de carte: " . $data['numerocarte'] . "<br>";
        echo "Nom carte: " . $data['nomcarte'] . "<br>";
        echo "Date d'expiration: " . $data['dateexpiration'] . "<br>";
        echo "Code de securité: " . $data['codesecurité'] . "<br>";
        }//end while

}//end if
//si le BDD n'existe pas
else {
    echo "Database not found";
}//end else
//fermer la connection
mysqli_close($db_handle);
?>
