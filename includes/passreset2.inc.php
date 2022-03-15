<?php

if (isset($_POST["submit-pass-reset2"])) {

    require_once 'database.inc.php';
    require_once 'functions.inc.php';
    
    
    $userName = mysqli_real_escape_string($conn, $_POST['user_name']);
    $userPass = $_POST["new_pass"];
    $userPassRepeat = $_POST["new_pass_repeat"];

    if (emptyInputPassReset($userName, $userPass, $userPassRepeat)) {
        header("location: ../profile.php?user=" . $userName ."&error=emptyfield");
        exit();
    } else if (passwordMatch($userPass, $userPassRepeat)) {
        header("location: ../profile.php?user=" . $userName ."&error=pwdnotmatching");
        exit();
    }

    updatePassword2($conn, $userName, $userPass);

} else {
    header("location: ../index.php");
    exit();
}
