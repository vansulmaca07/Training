<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $rfid = ($_POST["rfid"]);
    $GIDfetch  = ($_POST["GIDfetch"]);
   
    
    try {
        require_once "dbh2.inc.php";

       
       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE users
                        
        SET
            RFID = :rfid    
        WHERE
            GID = :GIDfetch;";
    
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(":rfid", $rfid);
        $stmt->bindParam(":GIDfetch", $GIDfetch);
          
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


