<?php

if (isset($_POST["submit-pass-reset"])) {
    


    require_once 'database.inc.php';
    require_once 'functions.inc.php';

    $userName = $_POST["user_name"];
    $userPass = $_POST["new_pass"];
    $userPassRepeat = $_POST["new_pass_repeat"];

    if(emptyInputPassReset($userName, $userPass, $userPassRepeat)){
        header("location: ../passwordReset.php?error=emptyfield");
        exit();
    }else if (passwordMatch($userPass, $userPassRepeat)) {
        header("location: ../passwordReset.php?error=pwdnotmatching");
        exit();
    }else if (usernameExists($conn, $userName, $userName) == false) {
        header("location: ../passwordReset.php?error=invalidusername");
        exit();
    }

    updatePassword($conn, $userName, $userPass);

}else{
        header("location: ../index.php");
        exit();
    }