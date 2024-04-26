<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $training_id = ($_POST["trainingDepartment"]) . ($_POST["trainingIdentifier"]);
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
    $purpose = ($_POST["purposeID"]);
    $audience = ($_POST["audienceID"]);
    $contents = ($_POST["contentsID"]);
    $usageid = ($_POST["usageID"]); 
    $statusid = '1';
    $creator = $_SESSION["GID"];
    $confirmation_by = ($_POST["confirmation_by"]);
    $confirmation_date = ($_POST["confirmation_date"]); 

    if(($_POST["category"]) === 'Other') {
    $category = ($_POST["category_other_manual"]);
    }
    else {
    $category = ($_POST["category"]);
    }
    //attendance table

    $checked_array = ($_POST["GIDcheck"]);
    $GIDname = ($_POST["GIDname"]);
    $firstname = ($_POST["name_"]);
    $surname = ($_POST["surname"]);
    $department_attendee = ($_POST["department_name"]);

    //
    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="INSERT INTO training_form (
            creator,
            document_id,
            creation_department,
            training_name,
            area,
            start_time_regular,
            end_time_regular,
            location_regular,
            instructor_regular,
            start_time_a,
            end_time_a,
            location_a,
            instructor_a,
            start_time_b,
            end_time_b,
            location_b,
            instructor_b,
            start_time_c,
            end_time_c,
            location_c,
            instructor_c,
            start_time_d,
            end_time_d,
            location_d,
            instructor_d,  
            category,
            purpose,
            audience,
            contents,
            usage_id,
            status_id,
            confirmation_by,
            confirmation_date 
            )

        VALUES (
            :creator,
            :document_id,
            :creationdepartment,
            :trainingname,
            :area,
            :starttimereg,
            :endtimereg,
            :locationreg,
            :instructorreg,
            :starttimeA,
            :endtimeA,
            :locationA,
            :instructorA,
            :starttimeB,
            :endtimeB,
            :locationB,
            :instructorB,
            :starttimeC,
            :endtimeC,
            :locationC,
            :instructorC,
            :starttimeD,
            :endtimeD,
            :locationD,
            :instructorD, 
            :category,
            :purpose,
            :audience,
            :contents,
            :usageid, 
            :statusid,
            :confirmation_by,
            :confirmation_date
        );";
         
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":creator", $creator);
        $stmt->bindParam(":document_id", $training_id);
        $stmt->bindParam(":creationdepartment", $creationdepartment);
        $stmt->bindParam(":trainingname", $trainingname);
        $stmt->bindParam(":area", $trainingloc);
        $stmt->bindParam(":starttimereg", $starttimereg);
        $stmt->bindParam(":endtimereg", $endtimereg);
        $stmt->bindParam(":locationreg",  $locationreg);
        $stmt->bindParam(":instructorreg", $instructorreg);
        $stmt->bindParam(":starttimeA", $starttimeA);
        $stmt->bindParam(":endtimeA", $endtimeA);
        $stmt->bindParam(":locationA", $locationA);
        $stmt->bindParam(":instructorA", $instructorA);
        $stmt->bindParam(":starttimeB", $starttimeB);
        $stmt->bindParam(":endtimeB", $endtimeB);
        $stmt->bindParam(":locationB", $locationB);
        $stmt->bindParam(":instructorB", $instructorB);
        $stmt->bindParam(":starttimeC", $starttimeC);
        $stmt->bindParam(":endtimeC", $endtimeC);
        $stmt->bindParam(":locationC", $locationC);
        $stmt->bindParam(":instructorC", $instructorC);
        $stmt->bindParam(":starttimeD", $starttimeD);
        $stmt->bindParam(":endtimeD", $endtimeD);
        $stmt->bindParam(":locationD", $locationD);
        $stmt->bindParam(":instructorD", $instructorD);  
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":purpose", $purpose);
        $stmt->bindParam(":audience", $audience);
        $stmt->bindParam(":contents", $contents);
        $stmt->bindParam(":usageid", $usageid);  
        $stmt->bindParam(":statusid", $statusid);
        $stmt->bindParam(":confirmation_by", $confirmation_by); 
        $stmt->bindParam(":confirmation_date", $confirmation_date);

        $stmt->execute(); 
         
        $query2 = "INSERT INTO attendance (GIDh,name_,training_id,affiliation) 
        VALUES (:GID,:firstname,:training_id,:department_name);";

        $stmt2 = $pdo->prepare($query2);
        
        foreach ($GIDname as $key => $value) {

            if(in_array($GIDname[$key], $checked_array)){
            $stmt2->bindParam(":GID", $GIDname[$key]);
            $stmt2->bindParam(":firstname", $firstname[$key]);
            $stmt2->bindParam(":training_id", $training_id); 
            $stmt2->bindParam(":department_name", $department_attendee[$key]);                       
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

        $pdo = null;
        $stmt = null;
        $stmt2= null;
        $stmr3= null;
        header("Location: ../progress.php");

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    
}
}
else {
    header("Location: ../progress.php");
}

