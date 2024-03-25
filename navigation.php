<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>

</head>
<body>
    <div class="full">
        <div class="menuDIV">
            <div class="loginDIV">
                    <p class="loginP">
                        <?php
                        
                        echo $_SESSION["surname"] .  $_SESSION["firstname"];
                    ?>
                    </p>
                    <p class="loginP">    <?php
                        echo $_SESSION["GID"];
                    ?></p>
                    <p class="loginP">    <?php
                        echo $_SESSION["userlevel"];
                    ?></p>
                    
                    <a href="includes/logout.inc.php"> <button class="btn">ログアウト</button> </a>        
            </div>
            <div class="navDIV">

                <?php
                
                if($_SESSION["userlevel"] === "administrator") {

                echo
                 '<a href="newform.php" class = "btn2">新規作成</a>
                 <a href="progress.php" class = "btn2">進捗状況</a>
                 <a href="training.php" class = "btn2">訓練</a>
                 <a href="registration.php" class = "btn2">IDカード登録</a>
                 <a href="namelist.php" class = "btn2">Namelist Master</a>
                 <a href="" class = "btn2">ユーザー管理</a>';

                }

                else if ($_SESSION["userlevel"] === "user") {
                echo 
                '<button class="btn4" onclick="displayRegForm()" disabled>新規作成</button></a>
                <button class="btn4" onclick="displayProgress()" disabled>進捗状況</button></a>
                <a href="training.php" class = "btn2">訓練</a>
                <button class="btn4" onclick="regSignature()" disabled >Namelist Master</button></a>
                <button class="btn4" onclick="userManagement()" disabled>ユーザー管理</button></a>';
            
                }
                
                else if ($_SESSION["userlevel"] === "leader") {
                echo 
                '<a href="newform.php" class = "btn2">新規作成</a>
                <a href="progress.php" class = "btn2">進捗状況</a>
                <a href="training.php" class = "btn2">訓練</a>
                <a href="namelist.php" class = "btn2">Namelist Master</a>
                <button class="btn4" onclick="userManagement()" disabled>ユーザー管理</button></a>';
                }
                ?>
            </div>
        </div>
        <div class="mainwrapper">
