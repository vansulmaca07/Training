<?php
session_start();

$training_id = $_SESSION["training_id"];

include_once "dbh2.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $query = "UPDATE training_form
        SET 
            approval = '2',
            approval_date = now(),
            status_id = '2'
        WHERE training_id = '$training_id';

      

    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $pdo =null;
    $stmt =null;

    header("Location: ../pdf_preview.php");

}
