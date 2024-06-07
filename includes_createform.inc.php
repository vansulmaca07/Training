<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

            $file_size_get = '';
            $file_type_get = '';

            $process_prefix = ($_POST["trainingDepartment"]);
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
            $count_value = ($_POST["count_value"]);
            $checker_comment_regular =($_POST["checker_comment_regular"]);
            $checker_people_regular =($_POST["checker_people_regular"]);
            $checker_date_regular = ($_POST["checker_date_regular"]);
            
            $category_quality='';
            if(isset($_POST["category_quality"])) {
            $category_quality = ($_POST["category_quality"]); }

            $category_environment = '';
            if(isset($_POST["category_environment"])) {
            $category_environment = ($_POST["category_environment"]);}

            $category_safety_and_hygiene = '';
            if(isset($_POST["category_safety_and_hygiene"])) {
            $category_safety_and_hygiene = $_POST["category_safety_and_hygiene"];}

            $category_others = '';
            if(isset($_POST["category_others"])) {
            $category_others = $_POST["category_others"];}

            $category_others_manual = '';
            if(isset($_POST["category_others_manual"])) {
            $category_others_manual = $_POST["category_others_manual"];}

            $categories = ($_POST["category"]);

            //attendance table

            $checked_array = ($_POST["GIDcheck"]);
            $GIDname = ($_POST["GIDname"]);
            $firstname = ($_POST["name_"]);
            $department_attendee = ($_POST["department_name"]);

            //
            try {
                require_once "dbh2.inc.php";

                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

                $query ="INSERT INTO training_form (
                    creator,
                    process_prefix,
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
                    purpose,
                    audience,
                    contents,
                    usage_id,
                    status_id,
                    confirmation_by,
                    confirmation_date,
                    count_,
                    checker_comment_regular,
                    checker_people_regular,
                    checker_date_regular,
                    category_quality,
                    category_environment,
                    category_safety_and_hygiene,
                    category_others,
                    category_others_manual
                    )

                VALUES (
                    :creator,
                    :process_prefix,
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
                    :purpose,
                    :audience,
                    :contents,
                    :usageid, 
                    :statusid,
                    :confirmation_by,
                    :confirmation_date,
                    :count_value,
                    :checker_comment_regular,
                    :checker_people_regular,
                    :checker_date_regular,
                    :category_quality,
                    :category_environment,
                    :category_safety_and_hygiene,
                    :category_others,
                    :category_others_manual
                );";
                
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":creator", $creator);
                $stmt->bindParam(":process_prefix", $process_prefix);
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
                $stmt->bindParam(":purpose", $purpose);
                $stmt->bindParam(":audience", $audience);
                $stmt->bindParam(":contents", $contents);
                $stmt->bindParam(":usageid", $usageid);  
                $stmt->bindParam(":statusid", $statusid);
                $stmt->bindParam(":confirmation_by", $confirmation_by); 
                $stmt->bindParam(":confirmation_date", $confirmation_date);
                $stmt->bindParam(":count_value", $count_value);
                $stmt->bindParam(":checker_comment_regular", $checker_comment_regular);
                $stmt->bindParam(":checker_people_regular", $checker_people_regular);
                $stmt->bindParam(":checker_date_regular", $checker_date_regular);
                $stmt->bindParam(":category_quality", $category_quality);
                $stmt->bindParam(":category_environment", $category_environment);
                $stmt->bindParam(":category_safety_and_hygiene", $category_safety_and_hygiene);
                $stmt->bindParam(":category_others", $category_others);
                $stmt->bindParam(":category_others_manual", $category_others_manual);

                $stmt->execute(); 

                $query1a ="SELECT * FROM training_form ORDER BY date_created DESC LIMIT 1";

                $stmt1a = $pdo->prepare($query1a);
                $stmt1a->execute();
                $result = $stmt1a->fetchAll();
                foreach($result as $row)
                {
                    $training_id=$row["training_id"];
                }
                
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

                //Upload File 

                  $allowed = array('jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx');
                $file_name_checking = $_FILES['file']['name'];
                $file_size_checking = $_FILES['file']['size'];

                $file_name_check_actual_ext = array();

                foreach ($file_name_checking as $extension_files) {

                    $extension_actual = explode('.', $extension_files);
                    $file_actual_Ext = strtolower(end($extension_actual));
                    $file_name_check_actual_ext[] = $file_actual_Ext;
                    
                }


                define('KB', 1024);
                define('MB', 1048576);
                define('GB', 1073741824);
                define('TB', 1099511627776);

                $file_name_check_ext = '';
                $file_name_check_ext = !array_diff($file_name_check_actual_ext, $allowed);

                if($file_name_check_ext === true) {
                    if(max($file_size_checking) < 20971520) {

                        foreach ($_FILES['file']['tmp_name'] as $key => $value) {
                            $file_name = $_FILES['file']['name'][$key];
                            $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                            $file_size = $_FILES['file']['size'][$key];
                            $file_error = $_FILES['file']['error'][$key];
                            $file_type = $_FILES['file']['type'][$key];

                            $file_ext = explode('.', $file_name);
                            $file_name_original = pathinfo($file_name, PATHINFO_FILENAME);
                            $file_actual_Ext = strtolower(end($file_ext));
                            
                            $file_name_new = $file_name_original.".".$file_actual_Ext; 

                            $file_destination = 'uploads/'.$file_name_new;

                            move_uploaded_file($file_tmp_name, $file_destination);

                            $query4 = "INSERT INTO file_storage (
                                file_name,
                                file_size,
                                file_type,
                                file_ext,
                                training_id,
                                uploaded_by
                                )
                                VALUES (
                                    :file_name, 
                                    :file_size, 
                                    :file_type,
                                    :file_ext,
                                    :training_id,
                                    :uploaded_by
                                ) 
                            ";

                            $stmt4=$pdo->prepare($query4);
                            $stmt4->bindParam(":file_name", $file_name_original);
                            $stmt4->bindParam(":file_size", $file_size);
                            $stmt4->bindParam(":file_type", $file_type);
                            $stmt4->bindParam(":file_ext", $file_actual_Ext);
                            $stmt4->bindParam(":training_id", $training_id);
                            $stmt4->bindParam(":uploaded_by", $creator);

                            $stmt4->execute();

                        }
                    } 
                    else {      
                        $file_size_get = "?error=large_file";
                    }
                } 
                else {     
                    $file_type_get = "?error=file_type";
                }

                //UPLOAD FILE END 

                //CATEGORY TABLE 

                

                foreach ($categories as $category_id) {
                    $query5 = "INSERT INTO category (category_id, category_others_name, training_id)
                          VALUES(
                            :category_id,
                            :category_others_name,
                            :training_id
                          )";
                    
                    $stmt5=$pdo->prepare($query5);
                    $stmt5->bindParam(":category_id", $category_id);
                    $stmt5->bindParam(":category_others_name", $category_others_manual);
                    $stmt5->bindParam(":training_id", $training_id);

                    $stmt5->execute();
                }

                $pdo = null;
                $stmt = null;
                $stmt1a = null;
                $stmt2= null;
                $stmt3= null;
                $stmt4= null;
                header("Location: ../progress.php". $file_type_get . $file_size_get);

                die();

            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());

            }
      
}

   

else {
    header("Location: ../progress.php");
}

