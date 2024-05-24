<?php

session_start();

include("dbh.inc.php");



    $training_id = $_SESSION["training_id"];

    $sql = "SELECT training_id, training_name, process_prefix, process_suffix,
    start_time_regular, end_time_regular, location_regular, instructor_regular, count_, date_created,
    category_quality, category_environment, category_safety_and_hygiene, category_others, category_others_manual, purpose, contents, usage_id, audience, area, confirmation_by, confirmation_date, department_name, name_, start_time_regular,
    checker_comment_regular, checker_people_regular
    FROM training_form

    INNER JOIN department on training_form.creation_department = department.department_id
    INNER JOIN users on training_form.creator = users.GID
    where training_id = '$training_id';";
                            
    $result = $conn->query($sql);
                            
    if (!$result) {
    die("Invalid Query: " . $connection->error);
    }

    while($row = $result->fetch_assoc()) {

    $_SESSION["creation_department"] = $row["creation_department"];
    $_SESSION["training_id"] = $row["training_id"];
    $_SESSION["training_name"] = $row["training_name"];
    $_SESSION["process_prefix"] = $row["process_prefix"]; 
    $_SESSION["process_suffix"] = $row["process_suffix"];
    $_SESSION["start_time_regular"] = $row["start_time_regular"];
    $_SESSION["end_time_regular"] = $row["end_time_regular"];
    $_SESSION["location_regular"] = $row["location_regular"];
    $_SESSION["instructor_regular"] = $row["instructor_regular"];
    $_SESSION["category_quality"] = $row["category_quality"];
    $_SESSION["category_environment"] = $row["category_environment"];
    $_SESSION["category_safety_and_hygiene"] = $row["category_safety_and_hygiene"];
    $_SESSION["category_others"] = $row["category_others"];
    $_SESSION["category_others_manual"] = $row["category_others_manual"];
    $_SESSION["purpose"] = $row["purpose"];
    $_SESSION["contents"] = $row["contents"];
    $_SESSION["usage_id"] = $row["usage_id"];
    $_SESSION["audience"] = $row["audience"];
    $_SESSION["area"] = $row["area"];
    $_SESSION["confirmation_by"] = $row["confirmation_by"];
    $_SESSION["confirmation_date"] = $row["confirmation_date"];
    $_SESSION["count_"] = $row["count_"];
    $_SESSION["date_created"] = $row["date_created"];
    $_SESSION["training_creator"] = $row["name_"];
    $_SESSION["start_time_regular"] = $row["start_time_regular"];
    $_SESSION["checker_people_regular"] = $row["checker_people_regular"];
    $_SESSION["checker_comment_regular"] = $row["checker_comment_regular"];
    
    header("location: ../editform.php");

    exit();
    }