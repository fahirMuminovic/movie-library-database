<?php
include_once "database.inc.php";
include_once "functions.inc.php";

$userName = $_GET['user'];

if (isset($_POST["odobri-button"])) {
    

    $id = $_POST["odobri-button"];
    $adminRequest = 0;
    $accType = 1;

    $sql = "UPDATE users SET userType = ?, zahtjevZaAdmina = ? WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=stmt1fail");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $accType, $adminRequest, $id);
        mysqli_stmt_execute($stmt);

        header("location: ../profile.php?user=" . $userName ."#table3");
        exit();
    }


}elseif (isset($_POST["odbij-button"])) {
   
    $id = $_POST["odbij-button"];
    $adminRequest = 0;
    $accType = 0;
    
    $sql = "UPDATE users SET userType = ?, zahtjevZaAdmina = ? WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=stmt1fail");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $accType, $adminRequest, $id);
        mysqli_stmt_execute($stmt);

        header("location: ../profile.php?user=" . $userName ."#table3");
        exit();
    }

}