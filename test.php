

<!DOCTYPE html>
<html>
  <head>
    <title>films</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylingdropdown.css">
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
        <b class="series" id="demo" >Series</b>
        <img src="psychology.png" alt="universe" width="60">
        <b class="series" id="genre" >genre</b>
</div>
  
      <div class="last">
      
        <b class="fav" id="fav">favoriet</b>
        <img class="prof" src="favorite.png" alt="profiel" width="50">
<div class="dropdown">
  <button class="dropbtn">Account</button>
  <div class="dropdown-content">
  <a href="#">profiel beheer</a>
  <a href="#">film/ serie toevoegen</a>
  <a href="uitlog.php">uitloggen</a>
  </div>
</div>
        <img class="prof" src="profile.png" alt="profiel" width="70">  

      </div>
    </div>

  

    <h1 class="welkom">Welkom bij fresh tomatoes!</h1>

    <div class="flex-container">
      <div class="favorietfilm">

      <?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$top = $pdo->query("SELECT id, titel, score, foto, type FROM film 
ORDER BY score DESC LIMIT 0, 5");
echo "<table>";
 echo "<tr>";
 echo "<th> Top 5 films";
 echo "<th> rating";
 echo "</tr>";
foreach ($top as $row) {
    if ($row["type"] === "normaal") {
        echo "<td>" . $row['titel'] . "</td>";
        echo "<td>" . $row['score'] . "</td>";
        echo "<td>" . $row['foto'] . "</td>";
      } 
      echo "</tr>";    
    }
    echo "</table>";
    
      ?>
      