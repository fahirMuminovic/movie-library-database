<?php

include_once "database.inc.php";
include_once "functions.inc.php";

if (isset($_POST["submit-about-user"])) {


    $actuallUserName = mysqli_real_escape_string($conn, $_POST['user_name']);

    $date = $_POST["dob"];
    $gender = $_POST["pol"];
    $aboutTxt = mysqli_real_escape_string($conn, $_POST['about']);

    if (empty($date) || empty($gender) || empty($aboutTxt)) {
        header("location: ../profile.php?user=" . $actuallUserName . "&error=emptyfieldAdminRequest");
        exit();
    }


    $file = $_FILES['profile-picture'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png", "gif", "svg");

    if ($fileSize !== 0) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {
                    $imgFullName = uniqid("profile-pic", true) . "." . $fileActualExt;
                    $fileDestination = "../images/profilepictures/" . $imgFullName;

                    $sql = "UPDATE users SET profilePicture = ?, dateOfBirth = ?, spol = ?, razlogZaZahtjev = ?, zahtjevZaAdmina = 1 WHERE usersUsername=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: ../profile.php?user=" . $actuallUserName . "&error=stmtfailAdminRequest");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssss", $imgFullName, $date, $gender, $aboutTxt, $actuallUserName);
                        mysqli_stmt_execute($stmt);

                        move_uploaded_file($fileTempName, $fileDestination);

                        header("location: ../profile.php?user=" . $actuallUserName . "&error=successAdminRequest");
                    }
                } else {
                    header("location: ../profile.php?user=" . $actuallUserName . "&error=filesizeerrorAdminRequest");
                    exit();
                }
            } else {
                header("location: ../profile.php?user=" . $actuallUserName . "&error=unknownerrorAdminRequest");
                exit();
            }
        } else {
            header("location: ../profile.php?user=" . $actuallUserName . "&error=wrongfiletypeAdminRequest");
            exit();
        }
    }
}

