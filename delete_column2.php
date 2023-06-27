<?php
// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "", "restaurant");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Vérifiez si l'ID de la colonne est fourni dans la demande POST
if (isset($_POST["id"])) {
    $id = $_POST["id"];

    // Exécutez la requête DELETE pour supprimer la colonne correspondante
    $query = "DELETE FROM dhow WHERE id = $id";
    $result = $mysqli->query($query);

    if ($result === true) {
        echo "La colonne a été supprimée avec succès";
    } else {
        echo "Une erreur s'est produite lors de la suppression de la colonne : " . $mysqli->error;
    }
}
?>
