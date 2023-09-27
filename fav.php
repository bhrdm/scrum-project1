<?php
include 'connect.php';
session_start();
if (empty($_SESSION['loggedInUser'])) {
  header('location: inlog.php');
}
$gebruiker = $_SESSION['loggedInUser'];

$id = $_SESSION['id'];
if ($_SESSION['fs'] === 'film') {
  try {
    $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  $count = $pdo->query("SELECT count(film_id) from favoriet where user_id = " . $gebruiker . " AND film_id = " . $id . "")->fetchColumn(); 

  if ($count == 0){

    $sql = $pdo->prepare("INSERT INTO favoriet (user_id, film_id) VALUES (:user_id, :film_id)");
    
    $sql->bindParam(':user_id', $gebruiker);
    $sql->bindParam(':film_id', $id);
      
    $sql->execute();
    header("Location: favoriet.php");
    exit;
  } else {
    header("Location: favoriet.php");
    exit;
  }
}
if ($_SESSION['fs'] === 'serie') {
  try {
    $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  $count = $pdo->query("SELECT count(serie_id) from favoriet where user_id = " . $gebruiker . " AND serie_id = " . $id . "")->fetchColumn();

  if ($count == 0){

    $sql = $pdo->prepare("INSERT INTO favoriet (user_id, serie_id) VALUES (:user_id, :serie_id)");

    $sql->bindParam(':user_id', $gebruiker);
    $sql->bindParam(':serie_id', $id);

    $sql->execute();

    header("Location: favoriet.php");
    exit;
  } else {
    header("Location: favoriet.php");
    exit;
  }
}
?>