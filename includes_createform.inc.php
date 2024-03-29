<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $creationdepartment = ($_POST["departmentID"]);
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

    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query ="INSERT INTO training_form (
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
            status_id 
            )

        VALUES (
            
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
            :statusid
        );";
         
      //  ALTER TABLE sg032
      //  add COLUMN SG033 varchar(50) not null;

      //  Alter TABLE sg032
      //  add COLUMN dateID033 datetime default null;";
        

        $stmt = $pdo->prepare($query);

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
