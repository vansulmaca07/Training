<?php

session_start();

$_SESSION["userlevel"] = "generaluser";
$_SESSION["documentNo"] = "";


header("location: ../attendance.php");
exit();


