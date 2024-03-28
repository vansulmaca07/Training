<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $idinput = ($_POST["RFID"]);
    $GIDfetch = ($_POST["GIDfetch"]);
 //   $department = $_SESSION["department"];
    
  /*  echo "$idinput";
    echo "$department";
    echo "$GIDget"; */

 
    try {
        require_once "dbh2.inc.php";

       
       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE users
                        
        SET
            RFID = :rfid    
        WHERE
            GID = :GID;";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":rfid", $idinput);
        $stmt->bindParam(":GID", $GIDfetch);
             
        $stmt->execute();

        $pdo = null;
        $stmt = null;

       
        header('location: ../idregistration.php');

        die();
        

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
        
    }

  


}
else {
    header("Location: ../idregistration.php");
}


