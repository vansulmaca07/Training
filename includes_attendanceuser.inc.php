<?php

session_start();

$_SESSION["userlevel"] = "generaluser";
$_SESSION["documentNo"] = "0";


header("location: ../attendance.php");
exit();

