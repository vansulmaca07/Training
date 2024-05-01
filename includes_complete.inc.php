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
