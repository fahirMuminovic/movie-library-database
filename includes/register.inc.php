<?php

    if(isset($_POST["signup-submit"])){

        $name = $_POST["name"];
        $username = $_POST["user_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password_repeat = $_POST["password_repeat"];

        require_once 'database.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputSignup($name, $username, $email, $password, $password_repeat ) !== false){

            header("location: ../register.php?error=emptyinput");
            exit();

        }
        if(invalidUserName($username) !== false){

            header("location: ../register.php?error=invalidUserName");
            exit();

        }
        if(invalidEmail($email) !== false){

            header("location: ../register.php?error=invalidEmail");
            exit();

        }        
        if(passwordMatch($password, $password_repeat) !== false){

            header("location: ../register.php?error=passwordsDontMatch");
            exit();

        }
        if(usernameExists($conn, $username, $email) !== false){

            header("location: ../register.php?error=usernameTaken");
            exit();

        }

        createUser($conn, $name, $email, $username, $password);
        
        
    }else{
        header("location: ../register.php");
        exit();
    }



?>