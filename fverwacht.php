<?php
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
    <link rel="stylesheet"  href="stylingdropdown.css">
    <style>
.background{
  display: flex;
  background-color: rgba(0,0,0,.5);

}

th,td{
  color: whitesmoke;
  font-style: oblique;
  font-weight: bold;
}
.info{
  display: flex;
margin-left: 200px;
 width: 600px;
 flex-wrap: wrap;
 border: 5px solid rgb(221, 185, 6);
}
.beschrijving{
  margin-top:  15px;
  border: 5px solid rgb(221, 185, 6);
  background-color: rgba(0,0,0,.5);
    color: #fff;
    font-weight: bold;
    font-style: oblique;
}
.welkom{
  font-size: 45px;

}
.h2{
  margin-left: 600px;
}
.film{
  background-color: rgba(0,0,0,.5);
}
.hartje{
  width: 80px;
  margin-left: 130px;
  margin-top: 100px;
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
        <b class="home " id="home">HOME</b>
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
<?php
if (isset($_GET['id'])) {
  $top = $pdo->query("SELECT * FROM fverwacht WHERE id =" . $_GET['id']);
  foreach ($top as $row) {
?>
<img class="prof" src="profile.png" alt="profiel" width="70"> 
      </div>
      
    </div>
      <h1 class="welkom"><?php echo $row["titel"] ?></h1>
    <div class="background">
      <?php
      echo "<iframe width=600 height=350 src=" . $row["youtube_trailer_id"] . "></iframe>";
      ?>
        <div class="info">
          <table class="film">
          <?php
            echo "<tr><td>Informatie</td><td></tr>";
            echo "<tr><td>Genre</td><td>" . $row['genre'] . "</td></tr>";
            echo "<tr><td>Release datum</td><td>" . $row['datum'] . "</td></tr>";
            echo "<tr><td>Duur</td><td>" . $row['taal'] . "</td></tr>";
          ?>
          </table>
        </div>

    </div>
    <div class="beschrijving">
      <h2 class="h2">beschrijving</h2>
      <?php echo $row["beschrijving"]?>
    </div>
<?php
  }
}
?>   
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
    document.getElementById("favoriet").onclick = function () {
        location.href = "favoriet.php";
    };
</script>