<?php

if (isset($_POST['submit-upload'])) {

    $newFileName = 'placeholder';
    $movieTitle = $_POST['moviename'];
    $movieYear = $_POST['movieyear'];
    $movieDirector = $_POST['director'];
    $movieActors = $_POST['actors'];
    $movieImdb = $_POST['imdblink'];
    $movieTrailer = $_POST['trailerlink'];
    $movieDescription = $_POST['descr'];
    $newFileName = strtolower(str_replace(array(" ", ":"), "-", $movieTitle));

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    
    if ($fileSize !== 0) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {
                    $imgFullName = $newFileName . "." . uniqid("IPI", true) . "." . $fileActualExt;
                    $fileDestination = "../images/movies/" . $imgFullName;

                    include_once "database.inc.php";

                    if (empty($movieTitle) || empty($movieYear) || empty($movieDirector) || empty($movieActors) || empty($movieImdb) || empty($movieTrailer) || empty($movieDescription)) {
                        header("Location: ../upload.php?error=emptyfield");
                        exit();
                    } else {
                        $sql = "SELECT * FROM movies;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../upload.php?error=stmtfail");
                            exit();
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $brojRedova = mysqli_num_rows($result);
                            $setMovieOrder = $brojRedova + 1;

                            $sql = "INSERT INTO movies (fileFullName, movieName, yearOfRelease, director, actors, imdbLink, trailerLink, sinopsis, orderMovies  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../upload.php?error=stmtfail");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "sssssssss", $imgFullName, $movieTitle, $movieYear, $movieDirector, $movieActors, $movieImdb, $movieTrailer, $movieDescription, $setMovieOrder);
                                mysqli_stmt_execute($stmt);

                                move_uploaded_file($fileTempName, $fileDestination);

                                header("Location: ../upload.php?error=success");
                            }
                        }
                    }
                } else {
                    header("Location: ../upload.php?error=filesizeerror");
                    exit();
                }
            } else {
                header("Location: ../upload.php?error=unknownerror");
                exit();
            }
        } else {
            header("Location: ../upload.php?error=wrongfiletype");
            exit();
        }
    }else {
        header("Location: ../upload.php?error=emptyfield");
        exit();
    }
}
