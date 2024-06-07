<?php

session_start();

$training_id = $_SESSION["training_id"];
include("dbh2.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   //attendance table
   
    $checked_array = ($_POST["GIDcheck_add"]);
    
    $GIDname = ($_POST["GIDname_add"]);
    $firstname = ($_POST["name_add"]);
    
    $department_attendee = ($_POST["department_name_add"]);
    
    try {

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query2 = "INSERT INTO attendance (GIDh,name_,training_id,affiliation,sign_progress,judgement) 
        VALUES (:GID,:firstname,:training_id,:department_name,:sign_progress,:judgement);";

        $stmt2 = $pdo->prepare($query2);

        $sign_progress = "1";
        $judgement = "1";
        
        foreach ($GIDname as $key => $value) {

            if(in_array($GIDname[$key], $checked_array)){
            $stmt2->bindParam(":GID", $GIDname[$key]);
            $stmt2->bindParam(":firstname", $firstname[$key]);
            $stmt2->bindParam(":training_id", $training_id);
            $stmt2->bindParam(":sign_progress",$sign_progress); 
            $stmt2->bindParam(":department_name", $department_attendee[$key]);
            $stmt2->bindParam(":judgement", $judgement);                         
            $stmt2->execute();
            }      
        }
        
        $query3= "UPDATE attendance 
        INNER JOIN users ON
        attendance.GIDh = users.GID
        SET 
        attendance.RFID = users.RFID
        ";

        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute();

    }

    catch (PDOException $e) {
    
        die("Query failed: " . $e->getMessage());

    }

     
}

else {
    header("Location: ../progress.php");
}



    

        
            




