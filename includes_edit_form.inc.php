<?php

session_start();

include("dbh.inc.php");


if ($_SERVER["REQUEST_METHOD"] == "POST")

    $training_id = $_POST["training_id"];

    $sql = "SELECT * FROM training_form
    where document_id = '$training_id';";
                            
    $result = $conn->query($sql);
                            
    if (!$result) {
    die("Invalid Query: " . $connection->error);
    }

    while($row = $result->fetch_assoc()) {

    $_SESSION["training_name"] = $row["training_name"];
    $_SESSION["training_id"] = $row["document_id"];
    $_SESSION["start_time_regular"] = $row["start_time_regular"];
    $_SESSION["end_time_regular"] = $row["end_time_regular"];
    $_SESSION["location_regular"] = $row["location_regular"];
    $_SESSION["instructor_regular"] = $row["instructor_regular"];
    $_SESSION["category"] = $row["category"];
    $_SESSION["purpose"] = $row["purpose"];
    $_SESSION["contents"] = $row["contents"];
    $_SESSION["usage_id"] = $row["usage_id"];
    $_SESSION["audience"] = $row["audience"];
    $_SESSION["area"] = $row["area"];
    
    header("location: ../editform.php");

        

    exit();
    }
