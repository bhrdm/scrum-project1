<?php
include 'connect.php';
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style_in_uit.css">
    <title>Aanmelden</title>
</head>
<body>
    <nav class="terug">
        <a href="inlog.php">Terug naar login</a>
    </nav>
    <div class="box">
        <h1>Aanmelden</h1>
        <form method="POST">
            <div class="email">
                <input type="email" placeholder="Email" name="email" id="email" required>
            </div>
            <div class="password">
                <input type="password" placeholder="Wachtwoord" name="password" id="password" required>
            </div>
            <div class="name">
                <input type="name" placeholder="Naam" name="name" id="name" required>
            </div>
            <div>
                <button type="submit" class="button" name="Aanmelden">Aanmelden</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["Aanmelden"])) {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Geen geldig email adres";
        }
        
        $query = $pdo->prepare("SELECT * FROM gebruikers WHERE email = ?");
        $query->execute([$email]);
        $result = $query->rowCount();

        if ($result > 0) {
            $error = print("Email bestaat al kies een andere email.. ");
        }

        $password = $_POST['password'];
        $name = $_POST['name'];

        if (empty($error)) {
            $sql = $pdo->prepare("INSERT INTO gebruikers SET 
                    email = :email, 
                    password = :password,
                    name = :name
                ");

            $sql->bindParam(':email', $_POST['email']);
            $sql->bindParam(':password', $_POST['password']);
            $sql->bindParam(':name', $_POST['name']);
        
            if ($sql->execute()) {
                header('location: inlog.php');
            }     
        }
    }
    ?>
</body>