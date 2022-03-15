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
                                echo "<li><a href='upload.php'>Upload</a></li>";
                            }
                        }
                        if (isset($_SESSION["useruid"])) {
                            echo "<li><a href='datatable.php' class='active'>Baza Podataka</a></li>";
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
        <div id="search-input-container"><input type="text" id="search-input" onkeyup="search()" placeholder="Pretražite Bazu Podataka.."></div>
    
        <section>

            <div class="data-container">
                <table id="table2">
                    <thead>
                    <tr>
                        <th data-type="number">Id.</th>
                        <th data-type="string">Naziv Filma</th>
                        <th data-type="number">Godina</th>
                        <th data-type="string">Režiser</th>
                        <th data-type="string">Glavne Uloge</th>
                        <th data-type="string">IMDB Link</th>
                        <th data-type="string">Trailer Link</th>
                        <th data-type="string">Opis</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php

                include_once 'includes/database.inc.php';

               

                $sql = "SELECT * FROM movies ORDER BY 'idMovie';";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Neočekivan Error!";
                } else {

                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {

                       echo "<tr class='tr'>";
                       echo "<td>" . $row['idMovie'] . "</td>";
                       echo "<td>" . $row['movieName'] . "</td>";
                       echo "<td>" . $row['yearOfRelease'] . "</td>";
                       echo "<td>";
                       /* koristi se foreach petlja i explode funkcija za prelazak u novi red ukoliko postoji zarez */
                       $seperated = $row['director'];
                       $directors = explode(",", $seperated);
                       foreach ($directors as $director) {
                           echo $director . "<br>";
                       }
                       echo "</td>";

                       echo "<td id='actors'>";
                       $seperated = $row['actors'];
                       $actors = explode(",", $seperated);
                       foreach ($actors as $actor) {
                        echo $actor . "<br>";
                       } 

                       echo "</td>";
                       echo "<td> <a target='_blank' href='" . $row['imdbLink'] . "' >" . $row['imdbLink'] . "</td>";
                       echo "<td> <a target='_blank' href='" . $row['trailerLink'] . "' >" . $row['trailerLink'] . "</td>";
                       echo "<td id='sinopsis'>" . $row['sinopsis'] . "</td>";
                       echo "</tr>";
                    }



                }
                ?>
                </tbody>
                </table>
            </div>


        </section>
    </main>

    <div class="spacer"></div>

    <section>
        <div>
            <footer>
                <?php include "includes/footer.php"?>
            </footer>
        </div>
    </section>
    <script src="js/datatable-script.js"></script>

</body>



</html>