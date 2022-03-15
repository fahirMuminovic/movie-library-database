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
    <script defer src="js/moreinfo-script.js"></script>
    <script defer src="js/moreinfo-delete-script.js"></script>
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

    <main>
        <div class="table-wrapper">
            <?php

            include_once 'includes/database.inc.php';

            $ID = mysqli_real_escape_string($conn, $_GET['id']);

            $sql = "SELECT * FROM movies WHERE idMovie = $ID ;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Neočekivan Error!";
            } else {

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='table-container'>";
                    echo "<table id='table'>";
                    echo "<tr>";
                    echo "<th>Ime Filma</th>";
                    echo "<td>" . $row['movieName'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Godina Prikazivanja</th>";
                    echo "<td>" . $row['yearOfRelease'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Režiser</th>";
                    $seperated = $row['director'];
                    $directors = explode(",", $seperated);
                    echo "<td>";
                    foreach ($directors as $director) {
                        echo $director . "<br>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Glavne Uloge</th>";
                    $seperated = $row['actors'];
                    $actors = explode(",", $seperated);
                    echo "<td>";
                    foreach ($actors as $actor) {
                        echo $actor . "<br>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>IMDB Link</th>";
                    echo "<td> <a target='_blank' href='" . $row['imdbLink'] . "' >" . $row['imdbLink'] . "</a></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Link za Trailer</th>";
                    echo "<td> <a target='_blank' href='" . $row['trailerLink'] . "' >" . $row['trailerLink'] . "</a></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Opis</th>";
                    echo "<td id='sinopsis'>" . $row['sinopsis'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
                if (isset($_SESSION["userType"])) {
                    $userType = $_SESSION["userType"];
                    if ($userType > 0) {
                        echo "<button id='edit'></button>";
                        echo "<button id='delete'></button>";
                    }
                }

                echo "</div>";
            }
            ?>
        </div>


        <!--popout ili modal za formu za editovanje podataka za film koji odgovara id-u iz url-a -->

        <div class="modal" id="modal">
            <div class="modal-header">
                <div class="title">Promijena podataka</div>
                <button id="close-modal-button" class="close-button">&times;</button>
            </div>
            <div class="modal-body">

                <!-- forma za unos podataka koji ce se izmijeniti u bazi -->
                <form id="update-form" class="updateForm" action="includes/update.inc.php?id=<?php echo $ID ?>" method="post" enctype="multipart/form-data">

                    <div class="input-control">
                        <input type="text" placeholder="Ime Filma" name="update-moviename" id="update-moviename">
                        
                    </div>

                    <div class="input-control">
                        <input type="text" placeholder="Godina Izdavanja" name="update-movieyear" id="update-movieyear">

                    </div>

                    <div class="input-control">
                        <input type="text" placeholder="Režiser" name="update-director" id="update-director">

                    </div>

                    <div class="input-control">
                        <input type="text" placeholder="Glumci" name="update-actors" id="update-actors">

                    </div>

                    <div class="input-control">
                        <input type="text" placeholder="IMDB Link" name="update-imdblink" id="update-imdblink">

                    </div>

                    <div class="input-control">
                        <input type="text" placeholder="Trailer Link" name="update-trailerlink" id="update-trailerlink">

                    </div>

                    <div class="input-control">
                        <input type="text" placeholder="Kratki Opis" name="update-descr" id="update-descr">

                    </div>

                    <div>
                        <p id="poster-prompt">odaberite sliku za poster filma</p>
                    </div>

                    <div class="input-control" id="fileup">
                        <input type="file" name="update-file" id="update-fileupload"><br>
                    </div>

                    <div>
                        <button type="submit" name="submit-update" id="update-submit">POTVRDI</button>
                    </div>
                </form>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "stmtfail") {
                        echo "<p id='error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                    } elseif ($_GET["error"] == "stmt2error") {
                        echo "<p id='error_msg'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                    }
                }
                ?>

            </div>
        </div>

        <div class="modal" id="delete-modal">
            <div class="modal-header2">
                <button id="close-delete-modal-button" class="close-button2">&times;</button>
            </div>
            <div class="modal2-body">
                <p id="delete-confirmation">DA LI STE SIGURNI DA ŽELITE <span>OBRISATI</span> FILM</p>
                <form class="deleteForm" action="includes/delete.inc.php" method="post">
                    <input type="hidden" name="id-to-delete" value="<?php echo $ID ?>">
                    <div class="buttons-delete-form">
                        <button type="submit" name="submit-delete" id="delete-submit">DA</button>
                </form>
                <button id="close-delete-modal-button2" class="close-button2">NE</button>
            </div>
        </div>
        </div>

        <div id="overlay"></div>

    </main>

    <div class="spacer"></div>

    <section>
        <div>
            <footer>
                <?php include "includes/footer.php" ?>
            </footer>
        </div>
    </section>
</body>

</html>