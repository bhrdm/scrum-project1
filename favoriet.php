<?php
include 'connect.php';
session_start();
if (empty($_SESSION['loggedInUser'])) {
    header('location: inlog.php');
}
$gebruiker = $_SESSION['loggedInUser'];
try {
  $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$gebruiker = $_SESSION['loggedInUser'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>films</title>
    <link rel="stylesheet" href="stylingdropdown.css">
    <link rel="stylesheet" href="favoriet.css">
    <style>
      .favoriet{
        width: 600px;
      }
      .box{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 160px;
         /* background-color: #181a4b; 
        padding: 50px;
        border-radius: 8px;
        opacity: 0.8;
         */
        font-weight: bold;
      }
      a {
            color: white;
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
        <p class="home " id="home">HOME</p>
        <img src="movie.png" alt="universe" width="60">
        <p class="series" id="demo" >Series</p>
        <img src="psychology.png" alt="universe" width="60">
        <p class="films" id="genre" >genre</p>
      </div>
      <div class="last">
        <p class="fav ">favoriet</p>
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
    <div class="background">
      <h1 class="welkom">Favorite</h1>
      <div class="box">
      <form method="POST">
        <input type="submit" value="FILMS" name="FILMS">
        <input type="submit" value="SERIES" name="SERIES">
      </form>
    <div>
          
      <div class="favoriet">
        <table>
        <?php
          if (isset($_POST['FILMS'])) {
            $sql = $pdo->query("SELECT fi.titel, fi.foto, fi.id FROM gebruikers g, favoriet fa, film fi WHERE g.id = $gebruiker AND fa.user_id = g.id AND fa.film_id = fi.id");
            $sql->execute();
            foreach ($sql as $row) {
              echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><td><a href='favoriet.php?id=" . $row['id'] . "'>Delete</a></td></tr>";
            }
            if (isset($_GET['id'])) {
              $delete = $pdo->query("DELETE FROM favoriet WHERE film_id=" . $_GET['id'] . " AND user_id =" . $gebruiker . "");
              header("Location: favoriet.php");
              exit;
            }
          }
          if (isset($_POST['SERIES'])) {
            $sql = $pdo->query("SELECT s.titel, s.foto, s.id FROM gebruikers g, favoriet fa, serie s WHERE g.id = $gebruiker AND fa.user_id = g.id AND fa.serie_id = s.id");
            $sql->execute();
            foreach ($sql as $row) {
              echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><td><a href='favoriet.php?id=" . $row['id'] . "'>Delete</a></td></tr>";
            }
            if (isset($_GET['id'])) {
              $delete = $pdo->query("DELETE FROM favoriet WHERE serie_id=" . $_GET['id'] . " AND user_id =" . $gebruiker . "");
              header("Location: favoriet.php");
              exit;
            }
          }
        ?>
        </table>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript">
  document.getElementById("demo").onclick = function () {
    location.href = "indexserie.php";
  };
  document.getElementById("home").onclick = function () {
    location.href = "index.php";
  };
  document.getElementById("genre").onclick = function () {
        location.href = "genrefilm.php";
    };
</script>