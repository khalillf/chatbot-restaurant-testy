<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "restaurant";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Échec de la connexion à la base de données: " . mysqli_connect_error());
}

if (isset($_GET['id_com'])) {
    $id_com = $_GET['id_com'];

    $sql = "SELECT id_com, nom, price,quantity FROM commande WHERE id_com = '$id_com'";
    $result = mysqli_query($conn, $sql);

    echo "<table id='detailsTable'>";
    if (mysqli_num_rows($result) > 0) {
        echo "<tr><th>ID de la commande</th><th>Nom</th><th>Prix</th><th>quantity</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_com'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Aucun détail de commande trouvé.</td></tr>";
    }
    echo "</table>";
}

mysqli_close($conn);
?>