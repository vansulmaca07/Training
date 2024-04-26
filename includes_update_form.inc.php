<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $training_id = $_POST["training_id"];
    $creationdepartment = $_SESSION["department"];
    $trainingname = ($_POST["educationID"]);
    $trainingloc = ($_POST["trainingLoc"]);
    $starttimereg = ($_POST["datetimeRegularStart"]);
    $endtimereg = ($_POST["datetimeRegularEnd"]);
    $instructorreg = ($_POST["instructorRegularID"]);
    $locationreg = ($_POST["LocationRegular"]);
    $starttimeA = ($_POST["datetimeAStart"]);
    $endtimeA = ($_POST["datetimeAEnd"]);
    $instructorA = ($_POST["instructorAID"]);
    $locationA = ($_POST["LocationA"]);
    $starttimeB = ($_POST["datetimeBStart"]);
    $endtimeB = ($_POST["datetimeBEnd"]);
    $instructorB = ($_POST["instructorBID"]);
    $locationB = ($_POST["LocationB"]);
    $starttimeC = ($_POST["datetimeCStart"]);
    $endtimeC = ($_POST["datetimeCEnd"]);
    $instructorC = ($_POST["instructorCID"]);
    $locationC = ($_POST["LocationC"]);
    $starttimeD = ($_POST["datetimeDStart"]);
    $endtimeD = ($_POST["datetimeDEnd"]);
    $instructorD = ($_POST["instructorDID"]);
    $locationD = ($_POST["LocationD"]); 
    $category = ($_POST["category"]);
    $purpose = ($_POST["purposeID"]);
    $audience = ($_POST["audienceID"]);
    $contents = ($_POST["contentsID"]);
    $usageid = ($_POST["usageID"]); 
    $statusid = '1';
    $creator = $_SESSION["GID"];
 
    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="UPDATE training_form
        
        SET 
            training_name = :training_name,
            area = :area,
            start_time_regular = :start_time_regular,
            end_time_regular = :end_time_regular,
            location_regular = :location_regular,
            instructor_regular = :instructor_regular,
            category = :category,
            purpose = :purpose,
            audience = :audience, 
            usage_id = :usage_id,
            contents = :contents

        WHERE
            document_id = :training_id
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":training_id", $training_id);
        $stmt->bindParam(":training_name", $trainingname);
        $stmt->bindParam(":area", $trainingloc);
        $stmt->bindParam(":start_time_regular", $starttimereg);
        $stmt->bindParam(":end_time_regular", $endtimereg);
        $stmt->bindParam(":location_regular",  $locationreg);
        $stmt->bindParam(":instructor_regular", $instructorreg);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":purpose", $purpose);
        $stmt->bindParam(":audience", $audience);
        $stmt->bindParam(":contents", $contents);
        $stmt->bindParam(":usage_id", $usageid);  
         
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../progress.php");

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    
    }
}

else {
    header("Location: ../progress.php");
}
                     


    
