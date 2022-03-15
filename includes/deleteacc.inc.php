<?php

session_start();

if (isset($_POST["acc-delete-submit"])) {

    require_once 'database.inc.php';
    require_once 'functions.inc.php';


    $userName = $_POST['user-acc'];
    $userPass = $_POST['user-pass'];
    $actuallUserName = $_POST['user_name'];


    if (emptyInputDeleteAcc($userName, $userPass)) {
        header("location: ../profile.php?user=" . $actuallUserName . "&error=emptyfieldAccDelete");
        exit();
    }



    deleteAcc($conn, $userName, $userPass, $actuallUserName);


    header("location: ../index.php");
    exit();
} else {
    header("location: ../index.php");
    exit();
}


function deleteAcc($conn, $userName, $userPass, $actuallUserName)
{
    $userData = usernameExists($conn, $userName, $userName);
    $usersEmail = $userData["usersEmail"];
    $usersId = $userData["usersId"];
    $actuallPass = $userData["usersPassword"];

    if ($userPass === $actuallPass) {
        if ($userName === $actuallUserName) {
            $sql = "DELETE FROM users WHERE usersId=? AND usersEmail=? OR usersUsername=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../profile.php?user=" . $actuallUserName . "&error=stmtfailedAccDelete");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sss", $usersId, $usersEmail, $userName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            
            session_unset();
            session_destroy();

            header("location: ../index.php");
            exit();
        } else {
            header("location: ../profile.php?user=" . $actuallUserName . "&error=wrongUserNameAccDelete");
            exit();
        }
    } else {
        header("location: ../profile.php?user=" . $actuallUserName . "&error=wrongPasswordAccDelete");
        exit();
    }
}
