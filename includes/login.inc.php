<?php

    if(isset($_POST["submit-login"])){
        $username = $_POST["user_name"];
        $password = $_POST["password"];

        require_once 'database.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputLogin($username, $password) !== false){

            header("location: ../login.php?error=emptyinput");
            exit();

        }

        loginUser($conn, $username, $password);

    }else {
        header("location: ../login.php");
        exit();
    }

?>