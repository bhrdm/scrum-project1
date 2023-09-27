<?php
include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style_in_uit.css">
    <title>Inlog</title>
</head>
    <?php
    $error = '';
    if (isset($_POST["inlog"])) {

        // check if username and password are from admin
        // true redirect to admin.php
        // true create session admin with value true to check if user is admin

        $adminUser = $pdo->prepare("SELECT username, password FROM `adminlogin`");
        $adminUser->execute();
        $total = $adminUser->fetchAll();    
        foreach ($total as $row) {
            if ($_POST["email"] === $row['username'] && $_POST["password"] === $row['password']) {
                $_SESSION["admin"] = true;
                header('Location: admin.php');
                exit;
            }
        }

        // false redirect to index.php

            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];
            $sql = $pdo->prepare("SELECT * FROM gebruikers WHERE email = :email AND password= :password ");
            $sql->bindParam("email", $_POST["email"]);
            $sql->bindParam("password", $_POST["password"]);
            $sql->execute();
            $Resultaat = $sql->fetchAll();

        if (count($Resultaat) > 0) {
            $_SESSION["loggedInUser"] = $Resultaat[0]['id'];
            $gebruiker = $_SESSION["loggedInUser"];
            
            header('Location: index.php');
            exit;
        } else {
            $error = "Gebruikersnaam of wachtwoord ongeldig";
        }
    }
    ?>
<body class="body">
    <div class="box">
        <h1>Inloggen</h1>
        <form method="POST">
            <div class="email">
                <input type="email" placeholder="Email" name="email" id="email" required>
            </div>
            <div class="password">
                <input type="password" placeholder="Wachtwoord" name="password" id="password" required>
            </div>
            <div>
                <button type="submit" class="button" name="inlog">Login</button>
            </div>
            <div>
                <p>Ben je nieuw hier?<a href="aanmelden.php">Meld je hier aan!</a></p>
            </div>
        </form>
    </div>
</body>
</html>