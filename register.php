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

    <header>
        <nav>
            <div class="nav">
                <ul>
                    <li class="home"><a href="index.php">Home</a></li>
                    <?php
                        if (isset($_SESSION["userType"])) {
                            $userType = $_SESSION["userType"];
                            if ($userType > 0) {
                                echo "<li><a href='upload.php'>Upload</a></li>";
                            }
                        }
                        if (isset($_SESSION["useruid"])) {
                            echo "<li><a href='datatable.php'>Baza Podataka</a></li>";
                            echo "<li><a href='profile.php?user=" . $_SESSION["useruid"] ."'>Profil</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
                        } else {
                            echo "<li><a href='login.php'>Log In</a></li>";
                            echo "<li><a href='register.php' class='active'>Register</a></li>";
                        }
                        ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="register">
        <form id="register_form" class="form" action="includes/register.inc.php" onsubmit="return checkInputs()" method="post">
            <h3>REGISTRACIJA</h3>

            <div class="input-control">
                <input type="text" placeholder="Vaše Puno Ime i Prezime" name="name" id="name">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="text" placeholder="Vaše Korisničko Ime" name="user_name" id="user_name">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="email" placeholder="Vaš E-mail" name="email" id="email">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="password" placeholder="Vaša Šifra" name="password" id="password">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="password" placeholder="Ponovite Šifru" name="password_repeat" id="password_repeat">
                <small id="small-error">Error message</small>
            </div>

            <div>
                <button name="signup-submit" type="submit" id="submit">REGISTRUJTE SE</button>
            </div>

            <div>
                <p id="small-text">Već imate račun? <a href="login.php">PRIJAVITE SE.</a></p>
            </div>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p id='error_msg'>Unesite vrijednosti u sva polja</p>";
                } else if ($_GET["error"] == "invalidUserName") {
                    echo "<p id='error_msg'>Unesite validno Korisničko Ime (a-Z  0-9)</p>";
                } else if ($_GET["error"] == "invalidEmail") {
                    echo "<p id='error_msg'>Unesite validan E-mail</p>";
                } else if ($_GET["error"] == "passwordsDontMatch") {
                    echo "<p id='error_msg'>Unesene Šifre nisu iste</p>";
                } else if ($_GET["error"] == "usernameTaken") {
                    echo "<p id='error_msg'>Unešeno Korisničko Ime ili E-mail već postoji</p>";
                } elseif ($_GET["error"] == "stmtfailed") {
                    echo "<p id='error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                } elseif ($_GET["error"] == "none") {
                    echo "<p id='success_msg'>REGISTRACIJA USPJELA. Molimo <a id='prijavitese' href='login.php'>prijavite se</a></p>";
                    header("refresh:2;url=login.php");
                    exit();
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


    <script src="js/register-script.js"></script>

</body>

</html>