<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}






table {
    border-collapse: collapse;
    width: 100%;
    max-width: 500px;
  }
  
  th, td {
    text-align: left;
    padding: 8px;
  }
  
  th {
    background-color: #333;
    color: white;
  }
  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
  tr:hover {
    background-color: #ddd;
  }
</style>
<script>
window.onload = function() {
  // Récupérer tous les liens dans la barre de navigation
  var links1 = document.getElementById("links1").getElementsByTagName("a");
  var links2 = document.getElementById("links2").getElementsByTagName("a");

  // Parcourir tous les liens du premier div et ajouter un gestionnaire d'événement de clic
  for (var i = 0; i < links1.length; i++) {
    links1[i].addEventListener("click", function() {
      // Supprimer la classe "active" de tous les liens du premier div
      for (var j = 0; j < links1.length; j++) {
        links1[j].classList.remove("active");
      }

      // Ajouter la classe "active" au lien sur lequel on a cliqué
      this.classList.add("active");
    });
  }

  // Parcourir tous les liens du deuxième div et ajouter un gestionnaire d'événement de clic
  for (var i = 0; i < links2.length; i++) {
    links2[i].addEventListener("click", function() {
      // Supprimer la classe "active" de tous les liens du deuxième div
      for (var j = 0; j < links2.length; j++) {
        links2[j].classList.remove("active");
      }

      // Ajouter la classe "active" au lien sur lequel on a cliqué
      this.classList.add("active");
    });
  }
};
</script>
</head>
<body>

<div class="topnav">
    <center>
  <div id="links1">
    <a class="active" href="#home">ON</a>
    <a href="#news">OF</a>
  </div>
  <div id="links2">
    <a class="active" href="#contact">libre</a>
    <a href="#about">livré</a>
  </div>
</center>
</div>

<br>
<h1>client table</h1>
<table>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Numéro</th>
      <th>Lieu</th>
      <th>Commande ID</th>
      <th>Total</th>
    </tr>
  
  <?php
  // Paramètres de connexion à la base de données
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "restaurant";
  
  // Connexion à la base de données
  $conn = mysqli_connect($host, $user, $password, $database);
  if (!$conn) {
      die("Échec de la connexion à la base de données: " . mysqli_connect_error());
  }
  
  // Requête SQL pour sélectionner les informations des clients
  $sql = "SELECT * FROM detail";
  $result = mysqli_query($conn, $sql);
  
  // Affichage des résultats dans le tableau HTML
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['Nom'] . "</td>";
          echo "<td>" . $row['Prénom'] . "</td>";
          echo "<td>" . $row['Numéro'] . "</td>";
          echo "<td>" . $row['Lieu'] . "</td>";
          echo "<td>" . $row['Commande ID'] . "</td>";
          echo "<td>" . $row['Total'] . "</td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='6'>Aucun enregistrement trouvé</td></tr>";
  }
  
  // Fermeture de la connexion à la base de données
  mysqli_close($conn);
  ?>
  
  </table>
</body>
</html>
