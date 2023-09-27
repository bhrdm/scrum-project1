<?php
session_start();
if ($_SESSION["admin"] != true) {
    header('Location: inlog.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>films</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"  href="stylingdropdown.css">
</head>
<body> 
    <style>
        h1{
            color: white;
        }
        table{
            font-size: 30px;
            color: white;
            font-weight: bold;
        }
        a {
            color: white;
        }
    </style>
    <div class="navbar">
        <div class="dropdown">
            <button class="dropbtn">Admin</button>
                <div class="dropdown-content">
                    <a href="admin.php">Admin panel</a>
                    <a href="uitlog.php">uitloggen</a>
                </div>
            </div>
        </div>
    <div class="body">
        <div class="buttons">
            <form method="POST">
                <input type="submit" value="FILMS" name="FILMS">
                <input type="submit" value="SERIES" name="SERIES">
            </form>
        </div>
    </div>
        <h1> Hallo Admin, wat wil jij doen?</h1>
<table>
<?php
if (!isset($_SESSION['media'])) {
    $_SESSION['media'] = "films";
}
if (isset($_POST['FILMS']) || $_SESSION['media'] == 'films') {
    $_SESSION['media'] = 'films';
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
    $top = $pdo->query("SELECT id, titel, foto FROM film");
    foreach ($top as $row) {
        echo "<div class='mediapiece'><tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='delete-media.php?id=" . $row['id'] . "'>Delete</a></td></tr></div>";
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete = $pdo->query("DELETE FROM film WHERE id=$id");
    }
} 
if (isset($_POST['SERIES']) || $_SESSION['media'] == 'series') {
    $_SESSION['media'] = 'series';
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
    $top = $pdo->query("SELECT id, titel, foto FROM serie");
    foreach ($top as $row) {
        echo "<div class='mediapiece'> <tr><td><img width=100 src=" . $row['foto'] . "></td><td>" . $row['titel'] . "</td><td><a href='delete-media.php?id=" . $row['id'] . "'>Delete</a></td></tr></div>";
    }
    if (isset($_GET['id'])) {
        $delete = $pdo->query("DELETE FROM serie WHERE id = " . $_GET['id'] . "");
    }
}
?>
</table>
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
    document.getElementById("favoriet").onclick = function () {
        location.href = "favoriet.php";
    };
</script>
