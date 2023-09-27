<?php
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"  href="stylingdropdown.css">
    <title> Edit media </title>
</head>
<body>

    <style>

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .titlechoose {
            color: white;
            font-size: 32px;
        }
        a {
            text-decoration: none;
            outline-color: white;
        }
        .edittitle {
            color: white;
        }
        .film {
            width: 50%;
        }

    </style>

    <div class="container">   
        <table>
    <?php

    require_once 'connect.php';

        if (isset($_POST["goback"])) {
            header('edit-media.php');
        } else if (!isset($_GET['id']) && !isset($_POST['goback'])) {
            $sqlfilms = $pdo->prepare("SELECT * FROM film");
            $sqlfilms->execute();

            $resultaatfilms = $sqlfilms->fetchAll();

            foreach ($resultaatfilms as $row) {
                echo "<div class='mediapiece'><tr><td><img width=100 src=" . $row['foto'] . "></td><td class='titlechoose'>" . $row['titel'] . "</td><td><a href='edit-media.php?id=movie" . $row['id'] . "'>Edit</a></td></tr></div>";
            }

            $sqlseries = $pdo->prepare("SELECT * FROM serie");
            $sqlseries->execute();

            $resultaatserie = $sqlseries->fetchAll();

            foreach ($resultaatseries as $row) {
                echo "<div class='mediapiece'><tr><td><img width=100 src=" . $row['foto'] . "></td><td class='titlechoose'>" . $row['titel'] . "</td><td><a href='edit-media.php?id=serie" . $row['id'] . "'>Edit</a></td></tr></div>";
            }

        } else if (strpos($_GET['id'], "m") === 0) {
            $id = substr($_GET['id'], -1);
            $sqlfilm = $pdo->prepare("SELECT * FROM film WHERE id = $id");
            $sqlfilm->execute();

            $resultaatfilm = $sqlfilm->fetchAll();
            foreach ($resultaatfilm as $film) {
                echo "<h1 class='edittitle'>" . $film['titel'] . "</h1>";
            }
            ?>

            <form method="POST">
            
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
            <?php

        } else if (strpos($_GET['id'], "s") === 0) {
            $id = substr($_GET['id'], -1);
            $sqlserie = $pdo->prepare("SELECT * FROM serie WHERE id = $id");
            $sqlserie->execute();

            $resultaatserie = $sqlserie->fetchAll();
            foreach ($resultaatserie as $serie) {
                echo "<h1 class='edittitle'>" . $serie['titel'] . "</h1>";
            }
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
        </table>
    </div>


</body>
</html>