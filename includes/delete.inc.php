<?php

include_once "database.inc.php";
include_once "functions.inc.php";

$ID = mysqli_real_escape_string($conn, $_POST['id-to-delete']);


if (isset($_POST['submit-delete'])) {

    $sql = "DELETE FROM movies WHERE idMovie = $ID;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=stmt1fail");
        exit();
    } else {
        mysqli_stmt_execute($stmt);

        header("location: ../index.php");
        exit();
    }
}
