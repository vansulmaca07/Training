<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $rfid = ($_SESSION["rfid"]);
  


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
            sg032.RFID = :RFID;

        UPDATE sg032
            SET 
            dateID = Now()

        WHERE 
            RFID = :RFID;";

       /* $query = "UPDATE currentstatus
        SET KP = :maintenanceid,
        statusid = :statusid
        where machineID = :machineid;";*/
      
        $stmt = $pdo->prepare($query);

      
        $stmt->bindParam("RFID", $rfid);
                     
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
