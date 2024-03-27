<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $rfid = ($_POST["rfid"]);
    $documentNo = $_SESSION["documentNo"];


    try {
        require_once "dbh2.inc.php";

       /* $query = "UPDATE attendance, signdb
        SET attendance.GID = signdb.GID

        where attendance.RFID = :rfid;"; */
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE sg032
                        
        INNER JOIN signdb ON sg032.RFID = signdb.RFID
        SET
            sg032.GID = signdb.GID
            
        WHERE
            sg032.RFID = :rfid
            AND sg032.training_id = :documentNo;
            

        UPDATE sg032
            SET 
            dateID = Now()

        WHERE 
            RFID = :rfid
            AND sg032.training_id = :documentNo;";
            

       /* $query = "UPDATE currentstatus
        SET KP = :maintenanceid,
        statusid = :statusid
        where machineID = :machineid;";*/
      
        $stmt = $pdo->prepare($query);

        $stmt->bindParam("rfid", $rfid);
        $stmt->bindParam("documentNo", $documentNo);
        
        
        
      
                     
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../Attendance.php");

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
        
    }

  
}
else {
    header("Location: ../Attendance.php");
}
