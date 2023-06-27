<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>PANDA Client List</title>
</head>
<body>
    <script>
        function refreshPage() {
            location.reload(); // Rafraîchir la page
        }
    </script>

    <center>
        <h1>Panda</h1>
        <h1>Client List</h1>
    </center>
    <style>
        h1 {
            font-size: 30px;
            color: #000000;
            text-transform: uppercase;
            font-weight: 300;
            text-align: center;
            margin-bottom: 15px;
            
        }
        table {
            width: 80%;
            table-layout: fixed;
        }
        .tbl-header {
            background-color: rgba(255,255,255,0.3);
        }
        .tbl-content {
            height: 300px;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        th {
            padding: 20px 15px;
            text-align: left;
            font-size: 14px;
            color: #000000;
            text-transform: uppercase;
            
        }
        td {
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 14px;
            color: #000000;
            border-bottom: solid 1px rgba(255,255,255,0.1);
        }

        /* demo styles */
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body {
            background: -webkit-linear-gradient(left, #e07979 20%, #ce79d7 100%);
            background: linear-gradient(to right, #acb6ce 20%, #5f8e89 100%);
            font-family: 'Roboto', sans-serif;
        }
        section {
            margin: 50px;
        }

        /* follow me template */
        .made-with-love {
            margin-top: 40px;
            padding: 10px;
            clear: left;
            text-align: center;
            font-size: 10px;
            font-family: arial;
            color: #fff;
        }
        .made-with-love i {
            font-style: normal;
            color: #F50057;
            font-size: 14px;
            position: relative;
            top: 2px;
        }
        .made-with-love a {
            color: #fff;
            text-decoration: none;
        }
        .made-with-love a:hover {
            text-decoration: underline;
        }

        /* for custom scrollbar for webkit browser*/
        ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #000000;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .delete-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #000000;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        
    .idd {
        /* Add your custom CSS styles for class "idd" here */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .po {
        /* Add your custom CSS styles for class "po" here */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }


        
    </style>
    <center>
<form method="post" class="bot">
    <button class="button" onclick="refreshPage()">Rafraîchir</button>
    <input class="button" type="submit" name="show_all_reservations" value="Afficher toutes les réservations">
    <input class="button" type="submit" name="show_current_day_reservations" value="Afficher les réservations du jour">
    <input class ="idd" type="text" name="client_number" placeholder="ID or number">
    <input class="po" type="date" name="filter_date">
    <button class="button" type="submit" name="show_reservation">Rechercher</button>
</form>
</center>
<?php
// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "", "restaurant");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the "Show All Reservations" button is clicked
if (isset($_POST["show_all_reservations"])) {
    // Fetch all reservations
    $query = "SELECT * FROM panda ORDER BY id DESC";
} else if (isset($_POST["show_reservation"])) {
    $id = $_POST["client_number"];
    $filterDate = $_POST["filter_date"];
    // Fetch reservations for the client number and date
    $query = "SELECT * FROM panda WHERE id = '$id' or num = '$id'or date = '$filterDate'";
} else if (isset($_POST["show_current_day_reservations"])) {
    // Fetch reservations for the current date
    $currentDate = date("Y-m-d");
    $query = "SELECT * FROM panda WHERE date = '$currentDate' ORDER BY id DESC";
} else {
    // Fetch reservations for the current date
    $currentDate = date("Y-m-d");
    $query = "SELECT * FROM panda WHERE date = '$currentDate' ORDER BY id DESC";
}

$result = $mysqli->query($query);

if ($result !== false && $result->num_rows > 0) {
    echo "<center>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Prénom</th>";
    echo "<th>Nom</th>";
    echo "<th>Num</th>";
    echo "<th>Date</th>";
    echo "<th>Heure</th>";
    echo "<th>Nombre de Place</th>";
    echo "<th>Type de table</th>";
    echo "<th>Sysdate</th>";
    echo "<th>Nobre de Visite</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='row" . $row["id"] . "'>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["prenom"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["num"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["heure"] . "</td>";
        echo "<td>" . $row["place"] . "</td>";
        echo "<td>" . $row["class"] . "</td>";
        echo "<td>" . $row["sysdate"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td><button class='delete-button' data-id='" . $row["id"] . "'>Supprimer</button></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";
} else {
    echo "<p>No reservations found</p>";
}
?>




<script>
    function deleteColumn(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette colonne ?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.open("POST", "delete_column.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + id);
        }
    }
    var deleteButtons = document.getElementsByClassName("delete-button");
    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener("click", function() {
            var id = this.getAttribute("data-id");
            deleteColumn(id);
        });
    }


    
</script>


</body>
</html>
