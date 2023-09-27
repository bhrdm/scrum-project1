<?php
session_start();
if ($_SESSION["admin"] != true) {
    header('Location: inlog.php');
    exit;
}

function uploadImage()
{
    $target_dir = "";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_POST['filmsubmit'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    uploadImage();
    
    $sql = $pdo->prepare("INSERT INTO film (titel, score, genre, taal, duur, datum, beschrijving, youtube_trailer_id, foto, type) 
    VALUES (:titel, :score, :genre, :taal, :duur, :datum, :beschrijving, :youtube_trailer_id, :foto, :type)");

    $sql->bindParam(':titel', $_POST['title']);
    $sql->bindParam(':score', $_POST['score']);
    $sql->bindParam(':genre', $_POST['genre']);
    $sql->bindParam(':taal', $_POST['taal']);
    $sql->bindParam(':duur', $_POST['duur']);
    $sql->bindParam(':datum', $_POST['datum']);
    $sql->bindParam(':beschrijving', $_POST['beschrijving']);
    $sql->bindParam(':youtube_trailer_id', $_POST['youtube_trailer_id']);
    $sql->bindParam(':foto', $_POST['foto']);
    $sql->bindParam(':type', $_POST['type']);

    $sql->execute();
}
if (isset($_POST['seriesubmit'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Fresh_tomatoes", 'bit_academy', 'bit_academy');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    uploadImage();

    $sql = $pdo->prepare("INSERT INTO serie (titel, score, genre, taal, seizoen, datum, beschrijving, youtube_trailer_id, foto, type) 
    VALUES (:titel, :score, :genre, :taal, :seizoen, :datum, :beschrijving, :youtube_trailer_id, :foto, :type)");

    $sql->bindParam(':titel', $_POST['title']);
    $sql->bindParam(':score', $_POST['score']);
    $sql->bindParam(':genre', $_POST['genre']);
    $sql->bindParam(':taal', $_POST['taal']);
    $sql->bindParam(':seizoen', $_POST['seizoen']);
    $sql->bindParam(':datum', $_POST['datum']);
    $sql->bindParam(':beschrijving', $_POST['beschrijving']);
    $sql->bindParam(':youtube_trailer_id', $_POST['youtube_trailer_id']);
    $sql->bindParam(':foto', $_POST['foto']);
    $sql->bindParam(':type', $_POST['type']);

    $sql->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>films</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"  href="stylingdropdown.css">
    <style>

        .background {
            display: flex;
            background-color: rgba(0,0,0,.5);
        }

        th,td {
            color: whitesmoke;
            font-style: oblique;
            font-weight: bold;
        }

        .info {
            width: 600px;
            border: 5px solid rgb(221, 185, 6);
        }

        .beschrijving {
            margin-top:  15px;
            border: 5px solid rgb(221, 185, 6);
            background-color: rgba(0,0,0,.5);
            color: #fff;
            font-weight: bold;
            font-style: oblique;
        }

        .welkom {
            font-size: 45px;
        }

        .info {
            display: flex;
        }

.table {
    display: flex;
    width: 100%;
}

        .h2 {
            margin-left: 600px;
        }

        .film {
            display: flex;
            background-color: rgba(0,0,0,.5);
            justify-content: center;
        }

        .info {
            display: flex;
            justify-content: center;
        }

        .dropdown > button {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .last {
            margin-right: 3rem;
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
        <div class="dropdown">
            <button class="dropbtn">Account<img class="prof" src="profile.png" alt="profiel" width="70"></button>
                <div class="dropdown-content">
                    <a href="#">Admin panel</a>
                    <a href="uitlog.php">uitloggen</a>
                </div>
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
<?php
if (isset($_POST['FILMS'])) {
    ?>
        <div class="info">
            <div class="table">
                <table class="film">
                    <form method="POST" enctype="multipart/form-data">
                        <tr><td> Film Toevoegen </td></tr>
                        <tr><td> Titel </td>
                            <td> <input type="text" name="title" placeholder="titel" />
                            </td>
                        </tr>
                        <tr>
                            <td>Taal</td>
                            <td><input type="text" name="taal" placeholder="taal"></td>
                        </tr>
                        <tr>
                            <td>Duur</td>
                            <td><input type="text" name="duur" placeholder="duur"></td>
                        </tr>
                        <tr>
                            <td>Datum</td>
                            <td><input type="text" name="datum" placeholder="datum"></td>
                        </tr>
                        <tr>
                            <td>genre</td>
                            <td> <input type="text" name="genre" placeholder="genre"></td>
                        </tr>
                        <tr>
                            <td>score</td>
                            <td> <input type="text" name="score" placeholder="score"></td>
                        </tr>
                        <tr>
                            <td> Beschrijving </td>
                            <td><input type="text" name="beschrijving" placeholder="beschrijving"></td>
                        </tr>
                        <tr>
                            <td>Youtube trailer id</td>
                            <td><input type="text" name="youtube_trailer_id" placeholder="trailer"></td>
                        </tr>
                        <tr>
                            <td>Foto naam</td>
                            <td><input type="text" name="foto" placeholder="foto"></td>
                        </tr>
                        <tr>
                            <td>Foto betand</td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>
                                <select name="type">
                                    <option value="netflix">netflix</option>
                                    <option value="normaal">normaal</option>
                                </select>
                            </td>
                        </tr>
                        <tr><td><input type="submit" value="submit" name="filmsubmit"></td></tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
    <?php
} else if (isset($_POST['SERIES'])) {
    ?>
        <div class="info">
            <div class="table">
                <table class="film">
                    <form method="POST" enctype="multipart/form-data">
                        <tr><td> Serie Toevoegen </td></tr>
                        <tr><td> Titel </td>
                            <td> <input type="text" name="title" placeholder="titel" />
                            </td>
                        </tr>
                        <tr>
                            <td>Taal</td>
                            <td><input type="text" name="taal" placeholder="taal"></td>
                        </tr>
                        <tr>
                            <td>Seizoenen</td>
                            <td><input type="text" name="seizoen" placeholder="seizoenen"></td>
                        </tr>
                        <tr>
                            <td>Datum</td>
                            <td><input type="text" name="datum" placeholder="datum"></td>
                        </tr>
                        <tr>
                            <td>genre</td>
                            <td> <input type="text" name="genre" placeholder="genre"></td>
                        </tr>
                        <tr>
                            <td>score</td>
                            <td> <input type="text" name="score" placeholder="score"></td>
                        </tr>
                        <tr>
                            <td>Beschrijving</td>
                            <td> <input type="text" name="beschrijving" placeholder="beschrijving"></td>
                        </tr>
                        <tr>
                            <td>Youtube trailer</td>
                            <td> <input type="text" name="youtube_trailer_id" placeholder="trailer"></td>
                        </tr>
                        <tr>
                            <td>Foto naam</td>
                            <td><input type="text" name="foto" placeholder="foto"></td>
                        </tr>
                        <tr>
                            <td>Foto bestand</td>
                            <td><input type="file" name="plaatje" placeholder="foto"></td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td> 
                                <select name="type">
                                    <option value="netflix">netflix</option>
                                    <option value="normaal">normaal</option>
                                </select>
                            </td>
                        </tr>
                        <tr><td><input type="submit" value="submit" name="seriesubmit"></td></tr>
                    </form>
                </table>
            </div>
        </div>
    <?php
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
</script>
