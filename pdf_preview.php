<?php

session_start();

include('includes/dbh2.inc.php');

$training_id = $_SESSION["training_id"];

$query = "SELECT date_id, affiliation, GIDh, name_, judgement_name FROM attendance
INNER JOIN judgement on attendance.judgement = judgement.id
WHERE training_id = '$training_id' limit 35;";

$stmt = $pdo->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll();
$total_row = $stmt->rowCount();

$query_02 = "SELECT date_id, affiliation, GIDh, name_, judgement_name FROM attendance
INNER JOIN judgement on attendance.judgement = judgement.id
where training_id = '$training_id' limit 35, 35
";

$stmt_02 = $pdo->prepare($query_02);
$stmt_02->execute();

$result_02 = $stmt_02->fetchAll();
$total_row_02 = $stmt_02->rowCount(); 

$query_03 = "SELECT date_id, affiliation, GIDh, name_, judgement_name FROM attendance
INNER JOIN judgement on attendance.judgement = judgement.id
where training_id = '$training_id' limit 70, 35
";

$stmt_03 = $pdo->prepare($query_03);
$stmt_03->execute();
$total_row_03 = $stmt_03->rowCount(); 

$result_03 = $stmt_03->fetchAll();

$query_04 = "SELECT date_id, affiliation, GIDh, name_, judgement_name FROM attendance
INNER JOIN judgement on attendance.judgement = judgement.id
where training_id = '$training_id' limit 105, 35
";

$stmt_04 = $pdo->prepare($query_04);
$stmt_04->execute();
$total_row_04 = $stmt_04->rowCount(); 

$result_04 = $stmt_04->fetchAll();

$query_05 = "SELECT date_id, affiliation, GIDh, name_, judgement_name FROM attendance
INNER JOIN judgement on attendance.judgement = judgement.id
where training_id = '$training_id' limit 140, 35
";

$stmt_05 = $pdo->prepare($query_05);
$stmt_05->execute();
$total_row_05 = $stmt_05->rowCount(); 

$result_05 = $stmt_05->fetchAll();

$query_06 = "SELECT date_id, affiliation, GIDh, name_, judgement_name FROM attendance
INNER JOIN judgement on attendance.judgement = judgement.id
where training_id = '$training_id' limit 175, 35
";

$stmt_06 = $pdo->prepare($query_06);
$stmt_06->execute();
$total_row_06 = $stmt_06->rowCount(); 

$result_06 = $stmt_06->fetchAll();


$query_07 = "SELECT * FROM training_form
    WHERE training_id = '$training_id'";

$stmt_07 = $pdo->prepare($query_07);
$stmt_07->execute();

$result_07 = $stmt_07->fetchAll();

$approval ='';
$approval_date = '';
$modified_date= '';
$status_id = '';

foreach ($result_07 as $result_approval) {
    $approval = $result_approval["approval"];
    $approval_date = $result_approval["approval_date"];
    $modified_date = $result_approval["modified_date"];
    $status_id = $result_approval["status_id"];
    
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="pdf_preview.css" class="href"> 
 

    <!-- Bootstrap 5 Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 

</head>
<body>
<div class="container" style="width:100%">

    <div class="column" style="float:left; width:20%;">
        <div class="digital-stamp">
            <div class="digital-stamp-creator" >
                
                <span><b>作成 :</b></span><br>
                <br>
                <span>部署</span>
                <input type="text"
                value="製造部"
                id=""
                class="input-creator-deployment input-left
                "
                onkeyup="input_data();"
                >
                <br>
                <span>氏名</span>
                <input type="text"
                value="<?php echo $_SESSION["training_creator"];?>"
                id="input-creator"
                class="input-creator input-left"
                onkeyup="input_data();"
                >
            </div>
            <div class="digital-stamp-approver" style="margin-top:20px;">
                
                <span><b>確認 :</b></span><br>
                <br>
                <span>部署</span>
                <input type="text"
                value="製造部"
                id=""
                class="input-creator-deployment input-left"
                onkeyup="input_data();"
                >
               <br>
                <span>氏名</span>
                <input type="text"
                value="<?php echo $_SESSION["name_"];?>"
                id="input-approver"
                class="input-approver input-left"
                onkeyup="input_data();"
                >
            
            </div>

            <?php
            if ($approval === '1' && $status_id === '3') {

            echo "
            <form action='includes/approval.inc.php' method='POST'>
            <button type='submit' name='submit' class='btn-approve input-left'>
                <span>確認</span>
            </button>
            </form>
            ";
            }

            else if ($approval === '2') {
            echo "<br>
            <span>APPROVED DATE:</span><br>";
            echo "<span>$approval_date</span><br>
            <br>";
            echo "<span>LAST MODIFIED DATE:</span><br>";
            echo "<span>$modified_date</span>";
            }
            
            ?>
            <div class="pdf-download">
            <button id="download" class="btn-pdf"><span>PDFダウンロード&nbsp;&nbsp;&nbsp;<i class="bi bi-file-earmark-arrow-down"></i></span></button>
            </div>
            
        </div>
    </div>
    <div class="column" style="float:right; width:80%;">
        <div class="book" id="test">
            <div class="page" id="page">
                <div class="subpage" id="subpage">
                    <div class="header-container">
                        <div class="header-1" style="width:100%;">
                            <div class="main_title">
                                <h3><b>教育・訓練記録（製造）</b></h3>
                            </div>
                            <div class="creation_department" id="creation_department">
                                <h3><b>作成部署:<?php echo $_SESSION["department_name"];?> </b></h3>
                            </div>
                        </div>
                        <div class="header-2" style="width:27%; text-align:center;">
                            <span style=""><u>NO.<?php echo $_SESSION["training_id"];?></u></span>
                            <table style="width:100%; margin-top:5px;">
                                <tr>
                                    <td style="width:50%; text-align:center;">
                                        <span>確　認</span>
                                    </td>
                                    <td style="width:50%; text-align:center;">
                                        <span>作　成</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:75px;">
                                    <div class="parent"
                                    
                                    <?php
                                        if($approval === '1') {
                                            echo "style='display: none;'";
                                        }

                                        else if ($approval === '2') {
                                            echo "style='display:flex;'";
                                        }
                                        
                                    ?>


                                  
             
                                    id="approver_div">
                                            <div class="child">
                                                <span-a id="deployment_approver">製造部</span-a>
                                                <span-a id="date_approved"></span-a>
                                                <span-a id="approver_stamp"></span-a>
                                            </div>
                                        </div>


                                    </td>
                                    <td style="height:75px;  align-items: center; justify-content: center;">
                                    
                                    <div class="parent">
                                        <div class="child">
                                            <span-a id="deployment_creator">製造部</span-a>
                                            <span-a id="date_created"></span-a>
                                            <span-a id="creator_stamp"></span-a>
                                        </div>
                                    </div>
                                    
                                
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="main_record" style="margin-top:5px;">
                        <table id="main_record" class="main_record" style="width:100%; margin-top: 10px;">
                            <tr>
                                <td style="width:70%;">
                                    <span>名称：<?php echo $_SESSION["training_name"];?></span>
                                </td>
                                <td style="width:15%; text-align:center;"> 
                                    <input type="checkbox" 
                                    <?php if ($_SESSION["area"]==='1'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    ><span>社内</span>
                                </td>
                                <td style="width:15%; text-align:center;">
                                <input type="checkbox"
                                    <?php if ($_SESSION["area"]==='2'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    >
                                    <span>社外</span>
                                </td>
                            </tr>
                        </table>

                        <table id="main_information" class="main_information" style="width:100%; border-top:0;">
                            <tr>
                                <td style="width:17%;">
                                    <span>日勤者実施日時：</span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span style="font-size:12px;"><?php echo $_SESSION["start_time_regular"]; ?></span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span style="font-size:12px;"><?php echo $_SESSION["end_time_regular"]; ?></span>
                                </td>
                                <td style="width:20%;">
                                    <span style="">場所：</span><span style="font-size:10px;"><?php echo $_SESSION["location_regular"]; ?></span>
                                </td>
                                <td style="width:20%;">
                                    <span style="">講師：</span><span style="font-size:12px;"><?php echo $_SESSION["instructor_regular"]; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:17%;">
                                    <span>Ａ班実施日時： </span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span></span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span></span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:17%;">
                                    <span>Ｂ班実施日時：   </span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span></span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span></span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:17%;">
                                    <span>Ｃ班実施日時：</span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span></span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span></span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:17%;">
                                    <span>Ｄ班実施日時：</span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span></span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span></span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="category" style="margin-top:10px;">
                        <caption>区分</caption>
                        <table id="category_table" class="category_table" style="width:100%">
                            <tr>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if ($_SESSION["category"]==='品質'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    >
                                    <span>品質</span>
                                </td>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if ($_SESSION["category"]==='環境'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    >
                                    <span>環境</span>                                   
                                </td>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if ($_SESSION["category"]==='安全衛生'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    >
                                <span>安全衛生</span>                               
                                </td>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if ($_SESSION["category"]!=='安全衛生' && $_SESSION["category"]!=='品質' && $_SESSION["category"]!=='安全衛生'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    >
                                    <span>その他:
                                    <?php if ($_SESSION["category"]!=='安全衛生' && $_SESSION["category"]!=='品質' && $_SESSION["category"]!=='安全衛生'){
                                        echo $_SESSION["category"];
                                    }
                                    
                                    ?>
                                    </span>                               
                                </td>
                            </tr>
                        </table>
                        ※安全衛生に関係する教育の場合、原本を総務部門に提出し、作成部署はコピーを保管する。
                    </div>
                    <div class="purpose"  style="margin-top:10px;">
                        <caption>目的、対象者</caption>
                        <table id="purpose_table" class="purpose_table" style="width:100%">
                            <tr>
                                <td colspan="2" style="width:100%;">
                                    <span>目的：<?php echo $_SESSION["purpose"]; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:25%;">
                                    <span>対象者：<?php echo $_SESSION["audience"]; ?></span>
                                </td>
                                <td style="width:25%;">
                                    <span>名：<?php echo $_SESSION["count_"]; ?></span>                                   
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="contents"  style="margin-top:10px;">
                        <caption>内容</caption>
                        <table id="contents_table" class="contents_table" style="width:100%">
                            <tr>
                                <td style="width:100%; height: 70px;">
                                    <span><?php echo $_SESSION["contents"]; ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="usage_materials"  style="margin-top:5px;">
                        <table id="usage_material_table" class="usage_material_table" style="width:100%">
                            <tr>
                                <td style="width:100%;">
                                    <span>使用資料　（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</span>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%; height: 40px;">
                                    <span><?php echo $_SESSION["usage_id"]; ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="methods_schedule"  style="margin-top:10px;">
                        <caption>教育効果の確認方法、確認予定日</caption>
                        <table id="methods_schedule_table" class="methods_schedule_table" style="width:100%">
                            <tr>
                                <td style="width:100%;">
                                    <span><?php echo $_SESSION["confirmation_by"]; ?></span>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <span>最終確認予定日：<?php echo $_SESSION["confirmation_date"]; ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="confirmation" style="width:100%; margin-top:10px;">
                        <div class="column-1" style="width:80%">
                            <caption>教育効果の確認結果</caption>
                            <table class="result_confirmation_regular" id="result_confirmation_regular" style="width:100%; margin-top:30px;">
                                <tr>
                                <td><span>日勤者：<?php echo $_SESSION["checker_people_regular"]; ?></span></td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span><?php echo $_SESSION["checker_comment_regular"]; ?></span></td>
                                </tr>
                            </table>
                            <table class="result_confirmation_regular" id="result_confirmation_regular" style="width:100%;  margin-top:30px;">
                                <tr>
                                <td ><span>Ａ班：</span></td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span></span></td>
                                </tr>
                            </table> 
                            <table class="result_confirmation_regular" id="result_confirmation_regular" style="width:100%;  margin-top:30px;">
                                <tr>
                                <td><span>Ｂ班：</span></td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span></span></td>
                                </tr>
                            </table> 
                            <table class="result_confirmation_regular" id="result_confirmation_regular" style="width:100%; margin-top:30px;">
                                <tr>
                                <td><span>Ｃ班：</span></td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span></span></td>
                                </tr>
                            </table>
                            <table class="result_confirmation_regular" id="result_confirmation_regular" style="width:100%; margin-top:30px;">
                                <tr>
                                <td><span>Ｄ班：</span></td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span></span></td>
                                </tr>
                            </table>     
                        </div>
                        <div class="column-2" style="width:20%">
                            <table class="effect_checker" style="float:right; width: 75%; text-align:center;">
                                <tr>
                                    <td><span>効果確認者</span></td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"></td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"></td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"></td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"></td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"></td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="page">
                <div class="subpage">
                    <div class="header" style="text-align:center; margin-top:50px;">
                    <h3>受講者（製造）</h3>
                    </div>
                    <div class="attendance">
                        <div class="column-1-b">
                            <table class="attendance-t-a" style="width:100%; margin-top:30px;">
                                    <thead>
                                        <th style="width:20%;">
                                        日付
                                        </th>
                                        <th style="width:20%;">
                                        所属
                                        </th>
                                        <th style="width:20%;">
                                        GID
                                        </th>
                                        <th style="width:25%;">
                                        氏名
                                        </th>
                                        <th style="width:15%;">
                                        認定
                                        </th>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        foreach($result as $row) {
                                            echo "
                                                <tr>
                                                    <td style='font-size:7px;'>$row[date_id]</td>
                                                    <td>$row[affiliation]</td>
                                                    <td>$row[GIDh]</td>
                                                    <td>$row[name_]</td>
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                            ";
                                        }

                                        
                                        $remainder = 35 - $total_row;

                                        for ($i=0; $i<$remainder; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
                                        ?>

                                        
                                    </tbody>
                            </table>
                        </div>
                        <div class="column-2-b">
                            <table class="attendance-t-b" style="width:100%; margin-top:30px;">
                                    <thead>
                                        <th style="width:20%;">
                                        日付
                                        </th>
                                        <th style="width:20%;">
                                        所属
                                        </th>
                                        <th style="width:20%;">
                                        GID
                                        </th>
                                        <th style="width:25%;">
                                        氏名
                                        </th>
                                        <th style="width:15%;">
                                        認定
                                        </th>
                                    </thead>
                                    <tbody>
                                        
                                    <?php 
                                        foreach($result_02 as $row) {
                                            echo "
                                                <tr>
                                                    <td style='font-size:7px;'>$row[date_id]</td>
                                                    <td>$row[affiliation]</td>
                                                    <td>$row[GIDh]</td>
                                                    <td>$row[name_]</td>
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                            ";
                                        }
                                        
                                        $remainder_02 = 35 - $total_row_02;

                                        for ($i=0; $i<$remainder_02; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
                                        ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!----- PAGE 2 (IF NECCESSARY)------> 


            <?php 
                if ($total_row_03 !== 0) {

                    echo "
                <div class='page'>
                    <div class='subpage'>
                        <div class='header' style='text-align:center; margin-top:50px;'>
                        <h3>受講者（製造）</h3>
                        </div>
                        <div class='attendance'>
                            <div class='column-1-b'>
                                <table class='attendance-t-a' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody> 

                                        ";

                                    }
            ?>
            <?php 
                                        foreach($result_03 as $row) {
                                            echo "
                                                <tr>
                                                    <td style='font-size:7px;'>$row[date_id]</td>
                                                    <td>$row[affiliation]</td>
                                                    <td>$row[GIDh]</td>
                                                    <td>$row[name_]</td>
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                            ";
                                        }
                                        
                                        $remainder_03 = 35 - $total_row_03;

                                        for ($i=0; $i<$remainder_03; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
            ?>

            <?php 
                if ($total_row_03 !== 0) {
                                        echo "
                                    
                                        </tbody>
                                </table>
                            </div>
                            <div class='column-2-b'>
                                <table class='attendance-t-b' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody>
                                        ";
                                    }                        
            ?>

            <?php 
                                        foreach($result_04 as $row) {
                                            echo "
                                                <tr>
                                                    <td style='font-size:7px;'>$row[date_id]</td>
                                                    <td>$row[affiliation]</td>
                                                    <td>$row[GIDh]</td>
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                            ";
                                        }
                                        
                                        $remainder_04 = 35 - $total_row_04;

                                        for ($i=0; $i<$remainder_04; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
            ?>

            <?php 
                if ($total_row_03 !== 0) {

                    echo"
                                
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
                    
                    
                    ";
                }
                
            ?>

            <!----- PAGE 3 (IF NECCESSARY)------> 


            <?php 
                if ($total_row_05 !== 0) {

                    echo "
                <div class='page'>
                    <div class='subpage'>
                        <div class='header' style='text-align:center; margin-top:50px;'>
                        <h3>受講者（製造）</h3>
                        </div>
                        <div class='attendance'>
                            <div class='column-1-b'>
                                <table class='attendance-t-a' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody> 

                                        ";

                                    }
            ?>
            <?php 
                                        foreach($result_05 as $row) {
                                            echo "
                                                <tr>
                                                    <td style='font-size:7px;'>$row[date_id]</td>
                                                    <td>$row[affiliation]</td>
                                                    <td>$row[GIDh]</td>
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                            ";
                                        }
                                        
                                        $remainder_05 = 35 - $total_row_05;

                                        for ($i=0; $i<$remainder_05; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
            ?>

            <?php 
                if ($total_row_05 !== 0) {
                                        echo "
                                    
                                        </tbody>
                                </table>
                            </div>
                            <div class='column-2-b'>
                                <table class='attendance-t-b' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody>
                                        ";
                                    }                        
            ?>

            <?php 
                                        foreach($result_06 as $row) {
                                            echo "
                                                <tr>
                                                    <td style='font-size:7px;'>$row[date_id]</td>
                                                    <td>$row[affiliation]</td>
                                                    <td>$row[GIDh]</td>
                                                    <td>$row[name_]</td>
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                            ";
                                        }
                                        
                                        $remainder_06 = 35 - $total_row_06;

                                        for ($i=0; $i<$remainder_06; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
            ?>

            <?php 
                if ($total_row_05 !== 0) {

                    echo"
                                
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
                    
                    
                    ";
                }
                
            ?>

        
        </div>   
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</div>   
</body>


<script type="text/javascript">

//GET THE FILE NAME

//Datetime

window.onload =function() {
    input_data();
// get the date created
    var date_created;

    var date_created = new Date('<?php echo $_SESSION["start_time_regular"];?>');
    var date_created_day =String(date_created.getDate()).padStart(2, '0');
    var date_created_month = String(date_created.getMonth() + 1).padStart(2, '0');
    var date_created_year = date_created.getFullYear();

    var date_file_name =date_created_year + date_created_month + date_created_day;
    var date_created_stamp = date_created_year + "." + date_created_month + "." + date_created_day;


    console.log(date_created_stamp);
    console.log(date_file_name);
    
    document.getElementById('date_created').innerHTML =date_created_stamp;

    var training_id = '<?php echo $training_id; ?>';
    var training_name = '<?php echo $_SESSION["training_name"]; ?>';
    var category = '<?php echo $_SESSION["category"]; ?>';

    var file_name_try = training_id.concat("_",date_file_name,"_",training_name,"(",category,")"); 

    console.log(file_name_try);

//get the date today

    



    document.getElementById("download")
    .addEventListener("click", () => {
        var test = this.document.getElementById("test");
        console.log(test);
        console.log(window);

        var options = {
            filename: file_name_try,
            image: { type: 'jpeg', quality: 1},
            html2canvas: { scale: 4},
            jsPDF: {putTotalPages: true},
        }; 
        
        html2pdf().set(options).from(test).save();
    })
}

    var input_creator;
    var input_approver;
    function input_data() {

    
    input_creator = document.getElementById('input-creator').value; 
    document.getElementById('creator_stamp').innerHTML = input_creator;

    input_creator = document.getElementById('input-approver').value; 
    document.getElementById('approver_stamp').innerHTML = input_creator;

 



    }
    
// function approve_data() {
    input_approver = document.getElementById('input-approver').value; 
    document.getElementById('approver_stamp').innerHTML = input_approver;

    var date_approved;

    var date_approved= new Date();
    var date_approved_day =String(date_approved.getDate()).padStart(2, '0');
    var date_approved_month = String(date_approved.getMonth() + 1).padStart(2, '0');
    var date_approved_year = date_approved.getFullYear();

    var deployment_approver;
    deployment_approver = '製造部';
    document.getElementById('deployment_approver').innerHTML =deployment_approver;

    var date_approved_stamp = date_approved_year + "." + date_approved_month + "." + date_approved_day;

    document.getElementById('date_approved').innerHTML = date_approved_stamp;
    //document.getElementById('approver_div').style.display = 'flex';

    //console.log()


//}

    


</script>

</html>
