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
                            echo "<li><a href='register.php'>Register</a></li>";
                        }
                        ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="reset">
        <form id="password_reset" class="form" action="includes/passreset.inc.php" method="post">
            <h3>PROMJENA SIFRE</h3>
            <div class="input-control">
                <input type="text" placeholder="Vaše Korisničko Ime ili e-mail" name="user_name" id="user_name">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="password" placeholder="Nova Šifra" name="new_pass" id="new_pass">
                <small id="small-error">Error message</small>
            </div>

            <div class="input-control">
                <input type="password" placeholder="Ponovite Novu Šifru" name="new_pass_repeat" id="new_pass_repeat">
                <small id="small-error">Error message</small>
            </div>

            <div>
                <button name="submit-pass-reset" type="submit" id="submit">POTVRDI</button>
            </div>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyfield") {
                    echo "<p id='error_msg'>Unesite vrijednosti u sva polja</p>";
                } else if ($_GET["error"] == "pwdnotmatching") {
                    echo "<p id='error_msg'>Unesene Šifre nisu iste";
                } else if ($_GET["error"] == "stmtfailed") {
                    echo "<p id='error_msg'>Neočekivana Greška!";
                } else if ($_GET["error"] == "invalidusername") {
                    echo "<p id='error_msg'>Korisničko Ime ili E-mail ne postoji";
                } else if ($_GET["error"] == "none") {
                    echo "<p id='success_msg'>Uspješno Ste promijenili šifru";
                    header("refresh:1;url=login.php");
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
    <script defer src="js/pass-reset-script.js"></script>
</body>

</html>