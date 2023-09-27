<?php
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>films</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylingdropdown.css">
    <style>
    .button-52 {
  font-size: 16px;
  font-weight: 200;
  letter-spacing: 1px;
  padding: 13px 20px 13px;
  outline: 0;
  border: 4px solid whitesmoke;
  cursor: pointer;
  position: relative;
  background-color: rgba(0, 0, 0, 0);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-52:after {
  content: "";
  background-color: rgb(221, 185, 6);
  width: 100%;
  z-index: -1;
  position: absolute;
  height: 100%;
  top: 7px;
  left: 7px;
  transition: 0.2s;
}

.button-52:hover:after {
  top: 0px;
  left: 0px;
}

@media (min-width: 768px) {
  .button-52 {
    padding: 13px 50px 13px;
  }
}
.genres{
    display: flex;
    justify-content: space-between;
    color: black;
}
a {
  text-decoration: none;
  
}

 table{
   color: lightgray;
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
        <b class="home" id="home">HOME</b>
        <img src="movie.png" alt="universe" width="60">
        <b class="series" id="demo" >Series</b>
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
    <h1 class="welkom">sorteer per genre FILM<h1>
      <div class="genres">
        <form method="POST">
          <button class="button-52" role="button" name="submit" value="horror"><p name="genre" value="horror">horror</p></button>
          <button class="button-52" role="button" name="submit1" value="actie"><p name="genre" value="actie">actie</p></button>
          <button class="button-52" role="button" name="submit2" value="sci-fi"><p name="genre" value="sci-fi">sci-fi</p></button>
          <button class="button-52" role="button" name="submit3" value="romantiek"><p name="genre" value="romantiek">romantiek</p></button>
          <button class="button-52" role="button" name="submit4" value="triller"><p name="genre" value="triller">thriller</p></button>
          <button class="button-52" role="button" name="submit5" value="comedy"><p name="genre" value="comedy">comedy</p></button>
        </form>
      </div>
    <table>
    <?php
      if (isset($_POST["submit"])) {
        $genre = $pdo->query("SELECT id, titel, score, foto, genre FROM film WHERE genre='horror'");
        foreach ($genre as $row) {
          echo "<body style='color:white'>";
          echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='film.php?id=" . $row['id'] . "'>></a></td></tr>";
        }
      }
      if (isset($_POST["submit1"])) {
        $genre = $pdo->query("SELECT id, titel, score, foto, genre FROM film WHERE genre='actie'");
        foreach ($genre as $row) {
          echo "<body style='color:white'>";
          echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='film.php?id=" . $row['id'] . "'>></a></td></tr>";
        }
      }
      if (isset($_POST["submit2"])) {
        $genre = $pdo->query("SELECT id, titel, score, foto, genre FROM film WHERE genre='sci-fi'");
        foreach ($genre as $row) {
          echo "<body style='color:white'>";
          echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='film.php?id=" . $row['id'] . "'>></a></td></tr>";
        }
      }
      if (isset($_POST["submit3"])) {
        $genre = $pdo->query("SELECT id, titel, score, foto, genre FROM film WHERE genre='romantiek'");
        foreach ($genre as $row) {
          echo "<body style='color:white'>";
          echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='film.php?id=" . $row['id'] . "'>></a></td></tr>";
        }
      }
      if (isset($_POST["submit4"])) {
        $genre = $pdo->query("SELECT id, titel, score, foto, genre FROM film WHERE genre='triller'");
        foreach ($genre as $row) {
          echo "<body style='color:white'>";
          echo "<tr><td><img  width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='film.php?id=" . $row['id'] . "'>></a></td></tr>";
        }
      }
      if (isset($_POST["submit5"])) {
        $genre = $pdo->query("SELECT id, titel, score, foto, genre FROM film WHERE genre='comedy'");
        foreach ($genre as $row) {
          echo "<body style='color:white'>";
          echo "<tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='film.php?id=" . $row['id'] . "'>></a></td></tr>";
        }
      }
      ?>
    </table>
  </body>
</html>
<?php

?>
<script type="text/javascript"> 
    document.getElementById("demo").onclick = function () {
      location.href = "indexserie.php";
    };
    document.getElementById("home").onclick = function () {
        location.href = "index.php";
    };
    document.getElementById("favoriet").onclick = function () {
        location.href = "favoriet.php";
    };
</script>

