<?php
include 'connect.php';
session_start();
if (empty($_SESSION['loggedInUser'])) {
    header('location: inlog.php');
}
$gebruiker = $_SESSION['loggedInUser'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>films</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylingdropdown.css">
    <style>
      a {
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="navbar">
      <div class="bit">
        <img src="logo.png" alt="bit academy" width="200">
      </div>
      <div class="midden">
        <img src="home.png" alt="home" width="60">
        <b class="home ">HOME</b>
        <img src="movie.png" alt="universe" width="60">
        <b class="films" id="films" >films</b>
        <img src="psychology.png" alt="universe" width="60">
        <b class="films" id="genre" >genre</b>
      </div>
      <div class="last">
      <b class="fav" id="favoriet">favoriet</b>
        <img class="prof" src="favorite.png" alt="profiel" width="50">
        <div class="dropdown">
  <button class="dropbtn">Account</button>
  <div class="dropdown-content">
  <a href="uitlog.php">uitloggen</a>
  </div>
</div> 
 <img class="prof" src="profile.png" alt="profiel" width="70"> 
      </div>
    </div>
    <h1 class="welkom">BEKIJK HIER SERIES<h1>
    <div class="flex-container">
      <div class="favorietfilm">
      <table>
          <tr>
            <th>Top 5 series</th>
            <th></th>
            <th>Rating</th>
          </tr>
          <?php
            try {
              $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }
            $top = $pdo->query("SELECT id, titel, score, foto, type FROM serie 
              ORDER BY score DESC LIMIT 0, 8");
            foreach ($top as $row) {
              if ($row["type"] === "normaal") {
                echo "<tr><td><img width=100 src=" . "" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td>" . $row['score'] . "</td><td><a href='serie.php?id=" . $row['id'] . "'>></a></td></tr>";
              }
            }
          ?>
        </table>
      </div>
      <div class="favorietserie">
      <table>
          <tr>
            <th>Top 5 netflix</th>
            <th></th>
            <th>Rating</th>
          </tr>
          <?php
            $top = $pdo->query("SELECT id, titel, score, foto, type FROM serie 
              ORDER BY score DESC LIMIT 0, 11");
            foreach ($top as $row) {
              if ($row["type"] === "netflix") {
                echo "<tr><td><img width=100 src=" . "" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td>" . $row['score'] . "</td><td><a href='serie.php?id=" . $row['id'] . "'>></a></td></tr>";
      
              }    
            }
          ?>
        </table>
      </div>
      <div class="komenuit">
      <table>
          <tr>
            <th> Word Verwacht</th>
          </tr>
          <?php
            try {
              $pdo1 = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
              $pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }

            $top = $pdo1->query("SELECT id, titel, foto, type FROM sverwacht LIMIT 0, 5");
            foreach ($top as $row) {
              echo "<tr><td><img width=100 src=" . "" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='sverwacht.php?id=" . $row['id'] . "'>></a></td></tr>";   
            }
          ?>
        </table>
      </div>  
    </div>
  </body>
</html>

<script type="text/javascript">
    document.getElementById("films").onclick = function () {
        location.href = "index.php";
    };
    document.getElementById("genre").onclick = function () {
        location.href = "genreserie.php";
    };
    document.getElementById("favoriet").onclick = function () {
        location.href = "favoriet.php";
    };
  
</script>
