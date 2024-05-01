<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $GID = $_POST["GIDinput"];
    $documentNo = $_SESSION["documentNo"];
  
    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE attendance
                        
        INNER JOIN users ON attendance.GIDh = users.GID
        SET
            attendance.sign_progress = '2'
            
        WHERE
            attendance.GIDh = :GID
            AND attendance.training_id = :documentNo;

        UPDATE attendance
            SET 
            date_id = Now()

        WHERE 
            GIDh = :GID
            AND training_id = :documentNo";

        $stmt = $pdo->prepare($query);

      
        $stmt->bindParam(":GID", $GID);
        $stmt->bindParam(":documentNo", $documentNo);
                     
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        
        header("Location: ../attendance.php");

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
        
    }

  
}
else {
    header("Location: ../Attendance_Bootstrap.php");
}
