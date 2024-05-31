<?php
// Vérification si le message est envoyé via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['client_id']) && isset($_POST['medecin_id'])) {
    // Récupération des données envoyées depuis la requête AJAX
    $message = $_POST['message'];
    $client_id = $_POST['client_id'];
    $medecin_id = $_POST['medecin_id'];

    // Connexion à la base de données
    $db_handle = mysqli_connect('localhost', 'root', 'root', 'medecing');

    // Vérification de la connexion
    if ($db_handle) {
        // Insérer une nouvelle entrée dans la table `medecinspe`
        $sql_insert_medecinspe = "INSERT INTO medecinspe (nom, spécialité) VALUES (?, ?)";
        
        if ($stmt = mysqli_prepare($db_handle, $sql_insert_medecinspe)) {
            $nom = "Nom Médecin";  // Remplacez par les données réelles si disponibles
            $specialite = "Spécialité";  // Remplacez par les données réelles si disponibles
            
            mysqli_stmt_bind_param($stmt, "ss", $nom, $specialite);
            
            if (mysqli_stmt_execute($stmt)) {
                $medecinspe_id = mysqli_insert_id($db_handle);
                
                // Préparation de la requête d'insertion du message dans la table message
                $sql_insert_message = "INSERT INTO message (medecing_id, medecinspe_id, client_id, conversation) VALUES (?, ?, ?, ?)";
                
                if ($stmt_message = mysqli_prepare($db_handle, $sql_insert_message)) {
                    mysqli_stmt_bind_param($stmt_message, "iiis", $medecin_id, $medecinspe_id, $client_id, $message);
                    
                    if (mysqli_stmt_execute($stmt_message)) {
                        echo "success";
                    } else {
                        //echo "Error inserting message: " . mysqli_error($db_handle);
                    }

                    mysqli_stmt_close($stmt_message);
                } else {
                    //echo "Error preparing message statement: " . mysqli_error($db_handle);
                }
            } else {
                //echo "Error inserting medecinspe: " . mysqli_error($db_handle);
            }

            mysqli_stmt_close($stmt);
        } else {
            //echo "Error preparing medecinspe statement: " . mysqli_error($db_handle);
        }

        mysqli_close($db_handle);
    } else {
        //echo "Error connecting to database: " . mysqli_connect_error();
    }
} else {
    //echo "Invalid request";
}
?>
