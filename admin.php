<?php
require_once 'connect.php';
    session_start();
    if ($_SESSION["admin"] != true) {
        header('Location: inlog.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_in_uit.css">
    <title>Admin panel</title>
    <style>
        h1{
            padding-top: 50px;
        }
        .box{
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1> ADMIN PANEL </h1>
    <div class="box">
        <h2><a href="add-media.php">Media toevoegen</a></h2>
        <h2><a href="delete-media.php">Media verwijderen</a></h2>
        <h2><a href="uitlog.php">Uitloggen</a></h2>
    </div>
</body>
</html>