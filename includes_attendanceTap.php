<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $rfid = ($_POST["rfid"]);
    $documentNo = $_SESSION["documentNo"];

    if($rfid !== "NULL") {

    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE attendance
                        
        INNER JOIN users ON users.RFID = attendance.RFID
        SET
            attendance.sign_progress = '2'
            
        WHERE
            attendance.RFID = :rfid
            AND attendance.training_id = :documentNo;
            
        UPDATE attendance
            SET 
            date_id = Now()

        WHERE 
            RFID = :rfid
            AND attendance.training_id = :documentNo;";
                
        $stmt = $pdo->prepare($query);

        $stmt->bindParam("rfid", $rfid);
        $stmt->bindParam("documentNo", $documentNo);
                          
        $stmt->execute();

        $stmt->closeCursor();

        $query_02 = "SELECT * FROM attendance
        where
            training_id = '$documentNo';
        ";

        $stmt_02 = $pdo->prepare($query_02);

        $stmt_02->execute();
        

        $result=$stmt_02->fetchAll();

        $stmt_02->closeCursor();

        $attendance_check = array();

        foreach ($result as $attendance) {
            $attendance_check[] = $attendance["sign_progress"];
        }

        if (arrayContainsOnlyZero($attendance_check) === true) {
            $query_03 = 
            "UPDATE training_form
                SET status_id = '3'
            WHERE training_id = '$documentNo'
            
            
            "; 
            
            $stmt_03 = $pdo->prepare($query_03);

            $stmt_03->execute();
            
            $stmt_03->closeCursor();
            
             
        } 


        $pdo = null;
        $stmt = null;
        $stmt_02 = null;
        $stmt_03 = null;

        header("Location: ../attendance.php");

        die();

    } catch (PDOException $e) {
        die("Query failed: ID card not in database" . $e->getMessage());
        

    }

    }

    else {
        print_r("Invalid ID");
        header("Location: ../attendance.php");
    }
  
}
else {
    header("Location: ../attendance.php");
}


function arrayContainsOnlyZero($array) {
    // Filter the array
    $filteredArray = array_filter($array, function($value) {
        return $value !== '2';
    });
    
    // Return boolean if only zero or not. True means all items are 0
    return empty($filteredArray);
}

