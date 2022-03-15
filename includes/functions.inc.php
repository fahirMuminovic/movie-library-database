<?php


function emptyInputSignup($name, $username, $email, $password, $password_repeat)
{

    $isValid = null;

    if (empty($name) || empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}

function invalidUserName($username)
{

    $isValid = null;
    $pattern = "/^[a-zA-Z0-9]*$/";
    if (!preg_match($pattern, $username)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}
function invalidEmail($email)
{

    $isValid = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}
function passwordMatch($password, $password_repeat)
{

    $isValid = null;
    if ($password !== $password_repeat) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}

function usernameExists($conn, $username, $email)
{

    $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $resultData = false;
        return $resultData;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $password)
{

    $sql = "INSERT INTO users (usersName, usersEmail, usersUsername, usersPassword) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../register.php?error=none");
    exit();
}

function emptyInputLogin($username, $password)
{

    $isValid = null;

    if (empty($username) || empty($password)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}

function emptyInput($input)
{
    $isValid = null;

    if (empty($input)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}

function loginUser($conn, $username, $password)
{

    $usernameExists = usernameExists($conn, $username, $username);

    if ($usernameExists === false) {
        header("location: ../login.php?error=notuser");
        exit();
    }

    $pass = $usernameExists["usersPassword"];


    if ($pass !== $password) {
        header("location: ../login.php?error=invalidLogin");
        exit();
    } else  if ($pass == $password) {

        session_start();

        $_SESSION["userid"] =  $usernameExists["usersId"];
        $_SESSION["useruid"] =  $usernameExists["usersUsername"];
        $_SESSION["userType"] = $usernameExists["userType"];


        header("location:../index.php");
        exit();
    }
}

function emptyInputPassReset($username, $password, $password_repeat)
{

    $isValid = null;

    if (empty($username) || empty($password) || empty($password_repeat)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}

function updatePassword($conn, $username, $newPassword)
{
    $userData = usernameExists($conn, $username, $username);
    $usersEmail = $userData["usersEmail"];

    $sql = "UPDATE users SET usersPassword=? WHERE usersEmail=? OR usersUsername=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../passwordReset.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $newPassword, $usersEmail, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../passwordReset.php?error=none");
    exit();
}

function updatePassword2($conn, $username, $newPassword)
{
    $userData = usernameExists($conn, $username, $username);
    $usersEmail = $userData["usersEmail"];

    $sql = "UPDATE users SET usersPassword=? WHERE usersEmail=? OR usersUsername=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?user=" . $username . "&error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $newPassword, $usersEmail, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../profile.php?user=" . $username . "&error=none");
    exit();
}

function emptyInputDeleteAcc($userName, $userPass)
{

    $isValid = null;

    if (empty($userName) || empty($userPass)) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}

function logOut(){
    session_start();
    session_unset();
    session_destroy();
}
