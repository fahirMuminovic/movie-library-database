<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>NOT NETFLIX</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section>
        <header>
            <nav>
                <div class="nav">
                    <ul>
                        <li class="home"><a href="index.php">Home</a></li>
                        <?php
                        if (isset($_SESSION["userType"])) {
                            $userType = $_SESSION["userType"];
                            if ($userType > 0) {
                                echo "<li><a href='upload.php' class='active'>Upload</a></li>";
                            }
                        }
                        if (isset($_SESSION["useruid"])) {
                            echo "<li><a href='datatable.php'>Baza Podataka</a></li>";
                            echo "<li><a href='profile.php?user=" . $_SESSION["useruid"] ."'>Profil</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
                        } else {
                            echo "<li><a href='login.php'>Log In</a></li>";
                            echo "<li><a href='register.php'>Register</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>
    </section>

    <div class="upload">
        <form id="upload_form" class="form" action="includes/upload.inc.php" onsubmit="return checkInputs()" method="post" enctype="multipart/form-data">
            <h3>UPLOAD</h3>

            <div class="input-control">
                <input type="text" placeholder="Ime Filma" name="moviename" id="moviename">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="Godina Izdavanja" name="movieyear" id="movieyear">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="Režiser" name="director" id="director">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="Glumci" name="actors" id="actors">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="IMDB Link" name="imdblink" id="imdblink">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="Trailer Link" name="trailerlink" id="trailerlink">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="Kratki Opis" name="descr" id="descr">
                <small id="small-error">Error message</small>
            </div>

            <div>
                <p id="poster-prompt">odaberite sliku za poster filma</p>
            </div>
      
            <div class="input-control" id="fileup">
                <input type="file" name="file" id="fileupload"><br>
            </div>

            <div>
                <button type="submit" name="submit-upload" id="submit">UPLOAD</button>
            </div>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyfield") {
                    echo "<p id='error_msg'>Unesite vrijednosti u sva polja</p>";
                } elseif ($_GET["error"] == "stmtfail") {
                    echo "<p id='error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                } elseif ($_GET["error"] == "filesizeerror") {
                    echo "<p id='error_msg'>Veličina fajla je prevelika</p>";
                } elseif ($_GET["error"] == "unknownerror") {
                    echo "<p id='error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                } elseif ($_GET["error"] == "wrongfiletype") {
                    echo "<p id='error_msg'>Odabrani File nije podržan</p>";
                } elseif ($_GET["error"] == "success") {
                    echo "<p id='success_msg'>FILE USPJEŠNO UPLOADOVAN</p>";
                }
            }
            ?>

        </form>
    </div>

    <div class="spacer"></div>

    <section>
        <div>
            <footer>
                <?php include "includes/footer.php"?>
            </footer>
        </div>
    </section>
        
            <script src="js/upload-script.js"></script>

</body>



</html>