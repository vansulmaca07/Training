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

  //  $sql = "SELECT * FROM users WHERE GID = ?;";

    $sql = "SELECT users.userlevel, users.GID, users.name_, users.RFID, users.pwd, users.department_id, dept.department_name

    FROM users
    
    INNER JOIN
    department AS dept
    
    ON
    
    users.department_id = dept.department_id
    
    where 
    
    users.GID =?;"; 

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
        $_SESSION["name_"] = $uidExists["name_"];
        $_SESSION["rfid"] = $uidExists["RFID"];
        $_SESSION["department_name"] = $uidExists["department_name"];
        $_SESSION["department"] = $uidExists["department_id"];
        
        
        header("location: ../home.php");
        exit();
    }
}

