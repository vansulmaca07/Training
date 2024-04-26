<?php

session_start ();

if ($_SERVER["REQUEST_METHOD"] == "POST")

    $_SESSION["documentNo"] = $_POST["documentNo"];

    header("location: ../attendance.php");
    exit();

