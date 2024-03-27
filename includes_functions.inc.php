<?php 


function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $username) {

    $sql = "SELECT * FROM users WHERE GID = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../loginpage.php?error=stmtfailed"); 
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }

    else {
        $result = false;
        return $result;
    }
}

function loginUser ($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username);

    if ($uidExists === false) {
        header(("location: ../loginpage.php?error=wronglogin"));
        exit();
    }

    $pwdDB = $uidExists["pwd"];
    
    if ($pwdDB !== $pwd) {
        header("location: ../loginpage.php?error=wronglogin");
        exit();
    }

    else if ($pwdDB === $pwd ) {
        session_start();
        $_SESSION["userlevel"] = $uidExists["userlevel"];
        $_SESSION["GID"] = $uidExists["GID"];
        $_SESSION["firstname"] = $uidExists["firstname"];
        $_SESSION["surname"] = $uidExists["surname"];
        $_SESSION["rfid"] = $uidExists["RFID"];
        
        
        header("location: ../home.php");
        exit();
    }
}

