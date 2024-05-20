<?php
session_start();
include("includes/dbh2.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--jQuery and Bootstrap CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

    <!--jQuery and Bootstrap javascript-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!--Icon Scout-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Bootstrap 5 Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 

    <title>Home</title>
</head>
<body>
    <div class="full">
        <div class="menuDIV">
            <div class="loginDIV">
                <p class="loginP" style="margin-top:15px; margin-bottom:0px;">
                    <?php
                        echo
                        $_SESSION["name_"];
                    ?>
                </p>
                <p class="loginP" style="margin:0px;">
                    <?php
                        echo $_SESSION["GID"];
                    ?>
                </p>
                <p class="loginP" style="margin:0px;">    
                    <?php
                        if ($_SESSION["userlevel"] === "1"){
                        echo "administrator";
                        }
                        else {        
                        }
                    ?>
                </p>
                <p class="loginP" style="margin:0px;">    
                    <?php
                        echo $_SESSION["department_name"];
                    ?>
                </p>  
                    <a href="includes/logout.inc.php" class="btn-34">ログアウト</a>   
            </div>
            <div class="navDIV">
                <?php
                if($_SESSION["userlevel"] === "1") {

                echo
                 '
                 <a href="progress.php" class = "btn-34"><span>進捗状況</span></a>
                 <a href="newform.php" class = "btn-34"><span>新規作成</span></a>
                 <a href="training.php" class = "btn-34"><span>訓練</span></a>
                 <a href="approval.php" class = "btn-34"><span>確認者確認・提出</span></a>
                 <a href="idregistration.php" class = "btn-34"><span>IDカード登録</span></a>
                 <a href="" class = "btn-34"><span>ユーザー管理</span></a>'
                 ;
                }

                else if ($_SESSION["userlevel"] === "3") {
                echo 
                '<button class="btn4" onclick="displayRegForm()" disabled>新規作成</button></a>
                <button class="btn4" onclick="displayProgress()" disabled>進捗状況</button></a>
                <a href="training.php" class = "btn-34">訓練</a>
                <button class="btn4" onclick="regSignature()" disabled >確認者確認・提出</button></a>
                <button class="btn4" onclick="regSignature()" disabled >IDカード登録</button></a>
                <button class="btn4" onclick="userManagement()" disabled>ユーザー管理</button></a>';
                }
                
                else if ($_SESSION["userlevel"] === "2") {
                echo 
                '<a href="progress.php" class = "btn-34">進捗状況</a>
                 <a href="newform.php" class = "btn-34">新規作成</a>
                 <a href="training.php" class = "btn-34">訓練</a>
                 <a href="approval.php" class = "btn-34">確認者確認・提出</a>
                 <a href="idregistration.php" class = "btn-34">IDカード登録</a>
                 <a href="" class = "btn4" disabled>ユーザー管理</a>';
                }
                
                ?>
            </div>
        </div>
        <div class="mainwrapper">
