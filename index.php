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
                        <li class="home"><a class="active" href="index.php">Home</a></li>
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
    </section>
    <section>
        <div class="neocekivana-greska">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmt1fail") {
                    echo "<p id='update_error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                } elseif ($_GET["error"] == "stmt2fail") {
                    echo "<p id='update_error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                }
            }
            ?>
        </div>
    </section>
    <section class="dobrodoslica-wrapper">
        <div class="dobrodoslica">
            <?php
            if (isset($_SESSION["useruid"])) {
                echo "<h1 id='welcome'>Dobrodošli " . $_SESSION["useruid"] .  "</h1>";
            }
            ?>
        </div>
    </section>

    <main>

        <!-- glavni dio strance koji pokazuje sve filmove u bazi podataka -->
        <section class="movies">

            <div class="wrapper">
                <div class="movie_container" id="movie_container">
                    <?php
                    include_once 'includes/database.inc.php';

                    $sql = "SELECT * FROM movies ORDER BY orderMovies DESC;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "Neočekivan Error!";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while ($row = mysqli_fetch_array($result)) {
                            echo  '<a id="containerZaPoster" target="_self" href="moreinfo.php?id=' . $row['idMovie'] . '">
                                    <div class="posterFilma" id="posterFilma" style="background-image: url(images/movies/' . $row["fileFullName"] . ');"><div id="info-container"><p id="klikZaInfo">KLIKNITE ZA VIŠE INFORMACIJA</p></div>
                                    <h3 id="nameOfMovie" >' . $row["movieName"] . '</h3>
                                    <h4 id="releaseDate" >' . $row["yearOfRelease"] . '</h4></div></a>';
                        }
                    }
                    ?>
                </div>

            </div>

    </main>

    <div class="spacer"></div>

    <section>
        <div>
            <footer style="margin-top: 5%;">
                <?php include "includes/footer.php"?>
            </footer>
        </div>
    </section>

    

</body>



</html>