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
            attendance.GID = users.GID
            
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

        $pdo = null;
        $stmt = null;

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
