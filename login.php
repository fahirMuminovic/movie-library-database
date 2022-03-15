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
                            echo "<li><a href='login.php' class='active'>Log In</a></li>";
                            echo "<li><a href='register.php'>Register</a></li>";
                        }
                        ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="login">
        
        <form id="login_form" class="form" action='includes/login.inc.php' method="post">
            <h3>PRIJAVA</h3>

            <div class="input-control">
                <input type="text" placeholder="Vaše Korisničko Ime ili e-mail" name="user_name" id="user_name">
                <small>Error message</small>
            </div>

            <div class="input-control">
                <input type="password" placeholder="Vaša Šifra" name="password" id="password">
                <small>Error message</small>
            </div>

            <div class="password-reset">
                <p id="small-text">Zaboravili Ste šifru? <a href="passwordReset.php">RESETUJTE JE.</a></p>
            </div>

            <div>
                <button name="submit-login" type="submit" id="submit">PRIJAVITE SE</button>
            </div>
            
            <div>
                <p id="small-text">Nemate račun? <a href="register.php">REGISTRUJTE SE.</a></p>
            </div>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p id='error_msg'>Unesite vrijednosti u sva polja</p>";
                } else if ($_GET["error"] == "invalidLogin") {
                    echo "<p id='error_msg'>Password nije tačan";
                }else if ($_GET["error"] == "notuser") {
                    echo "<p id='error_msg'>Korisničko ime ili E-mail nisu tačni";
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

    <script src="js/login-script.js"></script>
</body>

</html>