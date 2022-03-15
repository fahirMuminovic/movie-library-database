<?php

include_once "database.inc.php";
include_once "functions.inc.php";

$ID = $_GET['id'];


if (isset($_POST['submit-update'])) {


    // varijable koje se koriste za updateovanja
    $movieTitleUpdate = $_POST['update-moviename'];
    $movieYearUpdate = $_POST['update-movieyear'];
    $movieDirectorUpdate = $_POST['update-director'];
    $movieActorsUpdate = $_POST['update-actors'];
    $movieImdbUpdate = $_POST['update-imdblink'];
    $movieTrailerUpdate = $_POST['update-trailerlink'];
    $movieDescriptionUpdate = $_POST['update-descr'];

    $sql = "SELECT * FROM movies WHERE idMovie = $ID;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=stmt1fail");
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $movieTitleOld = $row['movieName'];
        }
    }

    $fileUpdate = $_FILES['update-file'];

    $fileName = $fileUpdate["name"];
    $fileType = $fileUpdate["type"];
    $fileTempName = $fileUpdate["tmp_name"];
    $fileError = $fileUpdate["error"];
    $fileSize = $fileUpdate["size"];
    $newFileName = $movieTitleOld;
    $newFileName = strtolower(str_replace(array(" ", ":"), "-",  $newFileName));

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) {
                $imgFullName = $newFileName . "." . uniqid("IPI", true) . "." . $fileActualExt;
                $fileDestination = "../images/movies/" . $imgFullName;
            }
        }
    }


    $sql = "SELECT * FROM movies WHERE idMovie = $ID;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=stmt1fail");
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $movieTitleOld = $row['movieName'];
            $movieYearOld = $row['yearOfRelease'];
            $movieDirectorOld = $row['director'];
            $movieActorsOld = $row['actors'];
            $movieImdbOld = $row['imdbLink'];
            $movieTrailerOld = $row['trailerLink'];
            $movieDescriptionOld = $row['sinopsis'];
            $fileFullNameOld = $row['fileFullName'];
        }

        //polja koja su ostavljena prazna u formi za update zadržat će vrijednosti koje imaju od prije
        if (empty($movieTitleUpdate)) {
            $movieTitleUpdate = $movieTitleOld;
        }

        if (empty($movieYearUpdate)) {
            $movieYearUpdate = $movieYearOld;
        }

        if (empty($movieDirectorUpdate)) {
            $movieDirectorUpdate = $movieDirectorOld;
        }

        if (empty($movieActorsUpdate)) {
            $movieActorsUpdate = $movieActorsOld;
        }

        if (empty($movieImdbUpdate)) {
            $movieImdbUpdate = $movieImdbOld;
        }

        if (empty($movieTrailerUpdate)) {
            $movieTrailerUpdate = $movieTrailerOld;
        }

        if (empty($movieDescriptionUpdate)) {
            $movieDescriptionUpdate = $movieDescriptionOld;
        }

        if (empty($imgFullName)) {
            $imgFullName = $fileFullNameOld;
            $fileDestination = "../images/movies/" . $imgFullName;
        }

    }

    // slučaj ako polje za unos nije prazno
    $sql = "UPDATE movies SET fileFullName = ?, movieName = ?, yearOfRelease = ?, director = ?, actors = ?, imdbLink = ?, trailerLink = ?, sinopsis = ? WHERE idMovie = $ID;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=stmt2fail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssss", $imgFullName, $movieTitleUpdate, $movieYearUpdate, $movieDirectorUpdate, $movieActorsUpdate, $movieImdbUpdate, $movieTrailerUpdate, $movieDescriptionUpdate);
    mysqli_stmt_execute($stmt);

    move_uploaded_file($fileTempName, $fileDestination);

    mysqli_stmt_close($stmt);

    header("location: ../moreinfo.php?id=" . $ID);
    exit();
}
