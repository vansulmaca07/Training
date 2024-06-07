<?php

session_start();

require_once "dbh2.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $training_id = $_SESSION["training_id"];
    $process_prefix = $_POST["process_prefix"];
    $process_suffix = $_POST["process_suffix"];
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
   
    
    /*$category = ($_POST["category"]);*/
   
    if(isset($_POST["category_quality"])) {
    $category_quality = ($_POST["category_quality"]); }

    
    if(isset($_POST["category_environment"])) {
    $category_environment = ($_POST["category_environment"]);}

    
    if(isset($_POST["category_safety_and_hygiene"])) {
    $category_safety_and_hygiene = $_POST["category_safety_and_hygiene"];}

    
    if(isset($_POST["category_others"])) {
    $category_others = $_POST["category_others"];}

    $category_others_manual='';
    if(isset($_POST["category_others_manual"])) {
    $category_others_manual = $_POST["category_others_manual"];}

    $purpose = ($_POST["purposeID"]);
    $audience = ($_POST["audienceID"]);
    $contents = ($_POST["contentsID"]);
    $usageid = ($_POST["usageID"]); 
    $statusid = '1';
    $creator = $_SESSION["GID"];
    $count_value = $_POST["count_value_input"];
    $checker_comment_regular =($_POST["checker_comment_regular"]);
    $checker_people_regular =($_POST["checker_people_regular"]);
    $confirmation_by = ($_POST["confirmation_by"]);
    $checker_date_regular = ($_POST["checker_date_regular"]);

    $training_id_temp = $process_prefix . $process_suffix;
   
    // Check for duplicate training id

    $query_training_id_checker = "SELECT training_id FROM training_form";
    $stmt_checker = $pdo->prepare($query_training_id_checker);
    $stmt_checker->execute();
    $result_training_id = $stmt_checker->fetchAll();

    $training_id_list = array();

    foreach($result_training_id as $result_training_id_list) {
        $training_id_list[] = $result_training_id_list["training_id"];
    }

    $training_id_list_new = array_diff($training_id_list, [$training_id]);



    if (!in_array($training_id_temp, $training_id_list_new)) {

        try {
            
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

            $query ="UPDATE training_form
            
            SET 
                training_name = :training_name,
                area = :area,
                start_time_regular = :start_time_regular,
                end_time_regular = :end_time_regular,
                location_regular = :location_regular,
                instructor_regular = :instructor_regular,
                category_quality = :category_quality,
                category_environment = :category_environment,
                category_safety_and_hygiene = :category_safety_and_hygiene,
                category_others = :category_others,
                category_others_manual = category_others_manual,
                purpose = :purpose,
                audience = :audience, 
                usage_id = :usage_id,
                contents = :contents,
                process_suffix = :process_suffix,
                count_ = :count_value,
                checker_comment_regular = :checker_comment_regular,
                checker_people_regular = :checker_people_regular,
                checker_date_regular = :checker_date_regular,
                confirmation_by = :confirmation_by,
                modified_date = now()
            
            WHERE
                training_id = :training_id;
            
            UPDATE attendance
            
            SET
                training_id = concat(:process_prefix, :process_suffix)
            

            WHERE
                training_id = :training_id;
                
            ";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":training_id", $training_id);
            $stmt->bindParam(":process_prefix", $process_prefix);
            $stmt->bindParam(":process_suffix", $process_suffix);
            $stmt->bindParam(":training_name", $trainingname);
            $stmt->bindParam(":area", $trainingloc);
            $stmt->bindParam(":start_time_regular", $starttimereg);
            $stmt->bindParam(":end_time_regular", $endtimereg);
            $stmt->bindParam(":location_regular",  $locationreg);
            $stmt->bindParam(":instructor_regular", $instructorreg);
            $stmt->bindParam(":category_quality", $category_quality);
            $stmt->bindParam(":category_environment", $category_environment);
            $stmt->bindParam(":category_safety_and_hygiene", $category_safety_and_hygiene);
            $stmt->bindParam(":category_others", $category_others);
            $stmt->bindParam(":category_others_manual", $category_others_manual);
            $stmt->bindParam(":purpose", $purpose);
            $stmt->bindParam(":audience", $audience);
            $stmt->bindParam(":contents", $contents);
            $stmt->bindParam(":usage_id", $usageid);
            $stmt->bindParam(":count_value", $count_value);
            $stmt->bindParam(":checker_comment_regular", $checker_comment_regular);
            $stmt->bindParam(":checker_people_regular", $checker_people_regular);
            $stmt->bindParam(":confirmation_by", $confirmation_by);
            $stmt->bindParam(":checker_date_regular", $checker_date_regular);
            
            
            $stmt->execute();

            $stmt->closeCursor();

            //attendance table

            $training_id_new = $process_prefix . $process_suffix;

            $GIDname = ($_POST["GIDname"]);
            $judgement = ($_POST["judgement"]);

            $query2= "UPDATE attendance 
            SET 
            judgement = :judgement
            WHERE 
                GIDh = :GID
                AND
                training_id = :training_id
            ";

            $stmt2 = $pdo->prepare($query2);

            foreach ($GIDname as $key => $value) {

                $stmt2->bindParam(":GID", $GIDname[$key]);
                $stmt2->bindParam(":judgement", $judgement[$key]);
                $stmt2->bindParam(":training_id", $training_id_new);
                $stmt2->execute();
                
            } 

            $stmt2->closeCursor();

            

            $query_03 = "SELECT * FROM training_form where training_id = '$training_id_new'";

            $stmt3 = $pdo->prepare($query_03);
            $stmt3->execute();

            $result = $stmt3->fetchAll();

            $status_id='';
            $confirmation_date_regular_check = '';
            $confirmation_comment_regular_check = '';
            foreach ($result as $result_status_id) {
                $status_id = $result_status_id["status_id"];
                $confirmation_date_regular_check = $result_status_id["checker_date_regular"];
                $confirmation_comment_regular_check = $result_status_id["checker_comment_regular"];
                $confirmation_people_regular_check = $result_status_id["checker_people_regular"];
            }

            $stmt3->closeCursor();

            if ($status_id === '3' && $checker_date_regular !== '' && $confirmation_comment_regular_check !== '' && $confirmation_people_regular_check !== '') {
                
                $query_change_stat = "UPDATE training_form
                    SET status_id = '4'
                    where training_id = '$training_id'";
                
                $stmt4 = $pdo->prepare($query_change_stat);

                $stmt4->execute();
            }

            $query5 = "DELETE FROM category where training_id = '$training_id'
            ";
            $stmt5 = $pdo->prepare($query5);
            $stmt5->execute();

            $new_category = array();
            $new_category = ($_POST["category"]);

            $training_id_new = $process_prefix . $process_suffix;

            foreach ($new_category as $category_id) {
                $query5 = "INSERT INTO category (category_id, category_others_name, training_id)
                      VALUES(
                        :category_id,
                        :category_others_name,
                        :training_id
                      )
                      ";
                
                $stmt5=$pdo->prepare($query5);
                $stmt5->bindParam(":category_id", $category_id);
                $stmt5->bindParam(":category_others_name", $category_others_manual);
                $stmt5->bindParam(":training_id", $training_id_new);

                $stmt5->execute();
            }

            $stmt = null;            
            $pdo = null;
           
            $_SESSION["training_id"] = $process_prefix . $process_suffix;

            header("Location: update_edit.inc.php");

            die();

        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        
        }
        
    }

    else {
        echo "Training ID already exist!";
        header(("location: ../editform.php?error=training_id_duplicate"));
    }

}
else {
    header("Location: ../update_edit.inc.php");
}




    
