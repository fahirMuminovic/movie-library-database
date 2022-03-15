<?php
session_start();

$user = $_GET['user'];

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
    <script src="js/profile-script.js" defer></script>
    <script src="js/profile-script2.js" defer></script>
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
                            echo "<li><a href='profile.php?user=" . $_SESSION["useruid"] . "' class='active'>Profil</a></li>";
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

        <div class="profile-wrapper">


            <?php
            include_once 'includes/database.inc.php';
            $sql = "SELECT zahtjevZaAdmina FROM users";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Neočekivan Error!";
            } else {
                
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_array($result)) {
                
                    $zahtjev = $row['zahtjevZaAdmina'];
                    if ($zahtjev === 0) {
                        $allAdminRequests = 0;
                        
                    }elseif ($zahtjev === 1) {
                        $allAdminRequests = 1;
                        break;
                    }
                }
            }


            $sql = "SELECT * FROM users WHERE usersUsername = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Neočekivan Error!";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_array($result)) {

                    $accType = $row['userType'];
                    $profilePicture = $row['profilePicture'];
                    $dob = $row['dateOfBirth'];
                    $spol = $row['spol'];
                    $userName = $row['usersUsername'];
                    $name = $row['usersName'];
                    $adminRequest = $row['zahtjevZaAdmina'];
                }
            }

            // echo "<p style='color:#fff;'>".$accType."</p>";
            // echo "<p style='color:#fff;'>".$adminRequest."</p>";

            if ($accType === 0 &&  $adminRequest === 0) {
                echo '<input type="hidden" id="showAdminRequestForm" value="1">';
                echo '<input type="hidden" id="showUserInfo" value="0">';
                echo '<input type="hidden" id="showAdminRequests" value="0">';
            } else if ($accType === 0 && $adminRequest === 1) {
                echo '<input type="hidden" id="showAdminRequestForm" value="0">';
                echo '<input type="hidden" id="showUserInfo" value="1">';
                echo '<input type="hidden" id="showAdminRequests" value="0">';
            } else if ($accType === 1 &&  $allAdminRequests === 0) {
                echo '<input type="hidden" id="showAdminRequestForm" value="0">';
                echo '<input type="hidden" id="showUserInfo" value="1">';
                echo '<input type="hidden" id="showAdminRequests" value="0">';
            } else if ($accType === 1 &&  $allAdminRequests === 1) {
                echo '<input type="hidden" id="showAdminRequestForm" value="0">';
                echo '<input type="hidden" id="showUserInfo" value="1">';
                echo '<input type="hidden" id="showAdminRequests" value="1">';
            }

            if ($accType == 0) {
                $tipRacuna = 'Korisnik';
            } elseif ($accType == 1) {
                $tipRacuna = 'Administrator';
            }

            ?>


            <div class="profile-container-4" id="target1">
                <form id="admin-request-form" action="includes/profile.inc.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyfieldAdminRequest") {
                            echo "<p id='error_msg_profile'>Unesite vrijednosti u sva polja</p>";
                        } elseif ($_GET["error"] == "stmtfailAdminRequest") {
                            echo "<p id='error_msg_profile'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                        } elseif ($_GET["error"] == "filesizeerrorAdminRequest") {
                            echo "<p id='error_msg_profile'>Veličina fajla je prevelika</p>";
                        } elseif ($_GET["error"] == "unknownerrorAdminRequest") {
                            echo "<p id='error_msg_profile'>Došlo je do neočekivane greške. Pokušajte ponovo</p>";
                        } elseif ($_GET["error"] == "wrongfiletypeAdminRequest") {
                            echo "<p id='error_msg_profile'>Odabrani File nije podržan</p>";
                        } elseif ($_GET["error"] == "successAdminRequest") {
                            echo "<p id='success_msg_profile'>vaš zahtjev je poslan</p>";
                        }
                    }
                    ?>
                    <h3>zahtjev za admina stranice</h3>
                    <h4>molimo popunite sljedeće informacije</h4>

                    <input type="hidden" id="user_name" name="user_name" value="<?php echo $user ?>">
                    <?php

                    echo '<div class="profile-pic" id="profile-pic" style="background-image: url(images/profilepictures/' . $profilePicture . ');"></div>';
                    ?>
                    <div class="input-control">
                        <input type="file" name="profile-picture" id="upload-profile-pic-button">
                    </div>

                    <div class="dob input-control">
                        <label for="dob">Godina Rođenja:</label>
                        <input type="date" name="dob" id="dob">
                    </div>

                    <small id="small-error-date">Unesite validan datum</small>

                    <div class="pol input-control">
                        <label for="pol">Spol:</label>
                        <input type="radio" name="pol" id="pol-musko" value="Muški" checked>
                        <label for="pol-musko" id="radio-label">Muški</label>
                        <input type="radio" name="pol" id="pol-zensko" value="Ženski">
                        <label for="pol-zensko" id="radio-label">Ženski</label>
                    </div>

                    <div class="about-requestAdmin input-control">
                        <label for="about">Napišite zašto želite biti admin</label>
                        <textarea name="about" id="about" cols="30" rows="10" placeholder="Vaš Tekst"></textarea>
                        <small id="small-error-textarea">Napišite razlog zbog kojeg podnosite zahtjev</small>
                    </div>

                    <div class="submit-button">
                        <button type="submit" name="submit-about-user">POTVRDI</button>
                    </div>

                </form>

            </div>

            <div class="profile-container-2" id="target2">

                <h3 style="margin-bottom: 375px;">Vaše Informacije</h3>

                <input type="hidden" id="user_name" name="user_name" value="<?php echo $user ?>">
                <?php
                echo '<p id="profilnaSlikaText">PROFILNA SLIKA</p>';
                echo '<div class="profile-pic" id="profile-pic" style="background-image: url(images/profilepictures/' . $profilePicture . ');"></div>';
                echo '<div id="infoConatainer">';
                echo '<div id="imePrezime">Ime Prezime: ' . $name . ' </div>';
                echo '<div id="korsnickoIme">Korisničko Ime: ' . $userName . '</div>';
                echo '<div id="datum">Datum rođenja: ' . $dob . '</div>';
                echo '<div id="spol">Spol: ' . $spol . '</div>';
                echo '<div id="tipRacuna">Tip Računa: ' . $tipRacuna . '</div>';
                echo '</div>';
                
                ?>

            </div>
                    

            <div class="profile-container-1-wrapper">
                <div class="profile-container-1">

                    <form id="password_reset2" action="includes/passreset2.inc.php" method="post">

                        <h3>PROMJENA ŠIFRE</h3>

                        <input type="hidden" id="user_name" name="user_name" value="<?php echo $user ?>">

                        <div class="input-control">
                            <input type="password" placeholder="Nova Šifra" name="new_pass" id="new_pass">
                            <small id="small-error">Error message</small>
                        </div>

                        <div class="input-control">
                            <input type="password" placeholder="Ponovite Novu Šifru" name="new_pass_repeat" id="new_pass_repeat">
                            <small id="small-error">Error message</small>
                        </div>

                        <div class="button-container">
                            <button name="submit-pass-reset2" type="submit" id="submit-pass-reset2">POTVRDI</button>
                        </div>

                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyfield") {
                                echo "<p id='error_msg'>Unesite vrijednosti u sva polja</p>";
                            } else if ($_GET["error"] == "pwdnotmatching") {
                                echo "<p id='error_msg'>Unesene Šifre nisu iste";
                            } else if ($_GET["error"] == "stmtfailed") {
                                echo "<p id='error_msg'>Neočekivana Greška!";
                            } else if ($_GET["error"] == "none") {
                                echo "<p id='success_msg'>Uspješno Ste promijenili šifru";
                            }
                        }
                        ?>
                    </form>
                </div>

                <div class="profile-container-1 delete-acc">

                    <form id="delete-account" action="includes/deleteacc.inc.php" method="post">


                        <h3>OBRIŠITE VAŠ RAČUN</h3>
                        <input type="hidden" id="user_name" name="user_name" value="<?php echo $user ?>">

                        <div class="input-control">
                            <input type="text" name="user-acc" id="user-acc" placeholder="Vaše korisničko ime ili e-mail">
                            <small id="small-error">Error message</small>
                        </div>
                        <div class="input-control">
                            <input type="password" name="user-pass" id="user-pass" placeholder="Vaša šifra">
                            <small id="small-error">Error message</small>
                        </div>
                        <button type="submit" name="acc-delete-submit" id="acc-delete-submit-btn">OBRIŠI RAČUN</button>
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyfieldAccDelete") {
                                echo "<p id='error_msg'>Unesite vrijednosti u sva polja</p>";
                            } else if ($_GET["error"] == "wrongPasswordAccDelete") {
                                echo "<p id='error_msg'>Unesena Šifra nije tačna";
                            } else if ($_GET["error"] == "stmtfailedAccDelete") {
                                echo "<p id='error_msg'>Neočekivana Greška!";
                            } else if ($_GET["error"] == "wrongUserNameAccDelete") {
                                echo "<p id='error_msg'>Uneseno korisničko ime ili email ne postoji";
                            } else if ($_GET["error"] == "noneAccDelete") {
                                echo "<p id='success_msg'>Uspješno Ste Obrisali Račun";
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>



        </div>
        <div class="container-3" id="showAdminRequestsContainer">
            <h3>PRISTIGLI ZAHTJEVI ZA ADMINISTRATORA STRANICE</h3>
            <form id="odobri-odbij-zahtjev-za-admina" method="POST" action="includes/requestAction.ini.php?user=<?php echo $user ?>">
                <table id="table3">
                    <thead>
                        <tr>
                            <th>Korisničko Ime</th>
                            <th>Datum Rođenja</th>
                            <th>Razlog Za Zahtjev Admina</th>
                            <th>Odobriti/Odbiti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once 'includes/database.inc.php';

                        $sql = "SELECT * FROM users WHERE zahtjevZaAdmina = 1;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "Neočekivan Error!";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while ($row = mysqli_fetch_array($result)) {
                                $razlog = $row['razlogZaZahtjev'];
                                $ime = $row['usersUsername'];
                                $godine = $row['dateOfBirth'];
                                $id = $row['usersId'];

                                echo "<tr>";
                                echo "<td>" . $ime . "</td>";
                                echo "<td>" . $godine . "</td>";
                                echo "<td>" . $razlog . "</td>";
                                echo "<td><button type='submit' name='odobri-button' id='odobri' value='" . $id . "' '>ODOBRITI</button> 
                                          <button type='submit' name='odbij-button' id='odbij' value='" . $id . "' '>ODBITI</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

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