<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $GIDfetch = ($_POST["GIDfetch"]);
    $training_id = ($_POST["training_id"]);
  
    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE attendance
                        
        INNER JOIN users ON attendance.GIDh = users.GID
        SET
            attendance.sign_progress = '2'
            
        WHERE
            attendance.GIDh = :GID
        AND
            attendance.training_id = :training_id;

        UPDATE attendance
            SET 
            date_id = Now()

        WHERE 
            GIDh = :GID
        AND
            training_id = :training_id";

        $stmt = $pdo->prepare($query);
      
        $stmt->bindParam(":GID", $GIDfetch);
        $stmt->bindParam(":training_id", $training_id);
                     
        $stmt->execute();

        $stmt->closeCursor();
        
        $query_02 = "SELECT * FROM attendance
        where
            training_id = '$training_id'
        ";

        $stmt_02 = $pdo->prepare($query_02);
        $stmt_02->execute();
        $result=$stmt_02->fetchAll();

       

        $attendance_check = array();

        foreach ($result as $attendance) {
            $attendance_check[] = $attendance["sign_progress"];
        }

        if (arrayContainsOnlyZero($attendance_check) === true) {
            $query_03 = 
            "UPDATE training_form
                SET status_id = '3'
            WHERE training_id = '$training_id'     
            "; 
            
            $stmt_03 = $pdo->prepare($query_03);

            $stmt_03->execute();
            
            $stmt_03->closeCursor();
            
             
        } 


        $pdo = null;
        $stmt = null;
   
        header("Location: ../training.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
        
    }
}
else {
    header("Location: ../training.php");
}

function arrayContainsOnlyZero($array) {
    // Filter the array
    $filteredArray = array_filter($array, function($value) {
        return $value !== '2';
    });
    
    // Return boolean if only zero or not. True means all items are 0
    return empty($filteredArray);
}
