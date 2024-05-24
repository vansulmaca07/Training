<?php
    include_once 'navigation.php';
    $group_ = $_SESSION["group_"];
    include_once 'includes/dbh2.inc.php';
    $GID_creator = $_SESSION["GID"];
    

$query_previous = 
    "SELECT * FROM training_form
        WHERE 
            creator = '$GID_creator'
        ORDER BY date_created DESC LIMIT 1";

$stmt_previous = $pdo->prepare($query_previous);
$stmt_previous->execute();

$result_previous_data = $stmt_previous->fetchAll();

$training_name_prev = '';
$process_prefix_prev = '';
$instructor_regular_prev = '';
$location_regular_prev = '';
$purpose_prev = '';
$audience_prev = '';
$contents_prev = '';
$usage_id_prev = '';


foreach ($result_previous_data as $prev_data) {
    $training_name_prev = $prev_data["training_name"];
    $process_prefix_prev = $prev_data["process_prefix"];
    $instructor_regular_prev = $prev_data["instructor_regular"];
    $location_regular_prev = $prev_data["location_regular"];
    $purpose_prev = $prev_data["purpose"];
    $audience_prev = $prev_data["audience"];
    $contents_prev = $prev_data["contents"];
    $usage_id_prev = $prev_data["usage_id"];
}





?>
    <!-----------REGISTRATION FORM----------->

<style> 
.wrapper {
    width: 100%;
    margin: 0;
   
}

.wrapper.active .content {
    display: block;
}

.select-btn, .options li{
    display: flex;    
    cursor: pointer;
    align-items: center;
}
.select-btn {
    height: 30px;
    padding: 0 7.5px;
    border-radius: 7px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    background-color: lightgoldenrodyellow;
    width: 95%;
    border: black;
    
}

.select-btn:focus {
    border: black;
}


.select-btn i {
    font-size: 10px;
    transition: transform 0.3s linear;
    
}

.wrapper.active .select-btn i {
    transform: rotate(-180deg);
}

.content {
    display: none;
    background: #fff;
    margin-top: 15px;
    border-radius: 7px;
    padding: 2px;
    width: 170px;
}

.content .search {
    position: relative;
}

.search i {
    left: 13px;
    color: #999;
    font-size: 10px;
    line-height: 45px;
    position: absolute;
}

.search input {
    height: 30px;
    width: 100%;
    outline: none;
    font-size: 10px;
    border-radius: 5px;
    padding: 0 15px 0 43px;
    border: 1px solid #b3b3b3;
}

/** Set the height of the box here**/
.content .options {                           
    margin-top: 10px;
    max-height: 250px;
    overflow-y: auto;
}

.options li{
    height: 50px;
    padding: 0 13px;
    font-size: 10px;
    border-radius: 5px;
}

.options li:hover{
    background: #f2f2f2
}
</style>
        <div class="main" id="main">
            
       
            <div class="scroll" id="div-scroll">

            <form action="includes/createform.inc.php" method="post" enctype="multipart/form-data">

                <div  id="creationdepartment">
                    <h2><b>作成部署: <?php echo $_SESSION["department_name"]; ?>
                    <input type="text"
                    style="width:15%"
                    hidden
                    name="departmentID"
                    id="departmentID"
                    value="<?php echo $_SESSION["department_name"]; ?>"
                    required></b>
                    </h2>
                </div> 
                <div id="mainrecord">
                    <table id="mainrecordTable" border="1" class="table table-sm table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tbody>
                            <tr style="width:100%">
                                <td style="width:50%">
                                    <span>名称：</span>
                                    <input type="text"
                                    name="educationID"
                                    id="educationID"
                                    value="<?php /* echo $training_name_prev; */?>"
                                    
                                    style="width:90%"
                                    required>
                                </td>
                                <td style="width:20%">
                                    <span>工程：</span>
                                    <select style="height: 30px;" name="trainingDepartment" id="trainingDepartment" required>
                                    <option value="" disabled selected hidden>Select</option>
                                        <?php

                                        if ($process_prefix_prev !== '') {
                                            echo "<option value= '$process_prefix_prev' selected>$process_prefix_prev</option>";
                                        }

                                        $query = "SELECT * FROM process_prefix
                                        ;";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        $php_array = [];
                                        foreach($result as $row)
                                        {
                                            echo "<option value= '$row[process_prefix]'>$row[process_prefix]</option>";
                                        };
                                        ?>
                                    </select>
                                    <!--<input type="text" name="trainingIdentifier" value="" style="width:25%">-->    
                                </td>
                                <td style="width:15%">
                                    <input type="radio" id="trainingLocInternal" name="trainingLoc" value="1" checked>
                                        <label for="trainingLocInternal" style="vertical-align:middle;">社内</label>
                                </td>
                                <td style="width:15%">
                                    <input type="radio" id="trainingLocExternal" name="trainingLoc" value="2">
                                        <label for="trainingLocExternal">社外</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="mainrecordTable2" class="table table-hover table-sm rounded-3 overflow-hidden mainrecordT2">
                        <tr style="width:100%;">
                            <td style="width:12%;">
                                <span>日勤者実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeRegularStart" id="datetimeRegularStart" value="" required>
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeRegularEnd" id="datetimeRegularEnd" value=""  required>
                            </td>
                            <td style="width:5%; padding: 0;">
                            場所：
                            </td>
                            <td style=" width:15%;">
                                <input type="text" id="LocationRegular" name="LocationRegular" value="<?php echo $location_regular_prev; ?>" required>
                            </td>
                            <td style="width:5%; padding: 0;">
                            講師：
                            </td>
                            <td>
                                <input type="text" id="trial_input" name="instructorRegularID" value="<?php
                                    if($instructor_regular_prev!=='') {
                                        echo $instructor_regular_prev;
                                    }
                                ?>" required hidden>
                            <!--SEARCH INSTRUCTOR-->
                                <div class="wrapper">
                                    <div class="select-btn">        
                                        <!--<span class="instructor_input">選択講師</span>-->
                                        <span class="instructor_input"><?php   if($instructor_regular_prev!=='') {
                                        echo $instructor_regular_prev;
                                    }
                                    else if ($instructor_regular_prev==='') {
                                        echo "選択講師";
                                    } ?></span>
                                        <i class="uil uil-angle-down"></i>
                                    </div>
                                    <div class="content" style="position:absolute;">
                                        <div class="search">
                                            <i class="uil uil-search"></i>
                                            <input type="text" placeholder="Search">
                                        </div>
                                        <ul class="options">
                                        <?php

                                          

                                           
                                                $query = "SELECT name_ from users
                                                    WHERE userlevel ='2'
                                                    ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    $php_array = [];
                                                    foreach($result as $row)
                                                    {
                                                    //    echo "
                                                    //        <li>$row[name_]</li>
                                                    //    ";
                                                        $php_array[]=$row["name_"];
                                                    }
                                                
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <!--SEARCH INSTRUCTOR-->
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td style="width:12%;">
                                <span>Ａ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeAStart" id="datetimeAStart" value="" >
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeAEnd" id="datetimeAEnd" value="">
                            </td>
                            <td style="width:5%; padding: 0;">
                            場所：
                            </td>
                            <td style=" width:15%;">
                                <input type="text" id="LocationA" name="LocationA" value="">
                            </td>
                            <td style="width:5%; padding: 0;">
                            講師：
                            </td>
                            <td>
                                <input type="text" id="trial_input" name="instructorAID" value=""  hidden>
                            <!--SEARCH INSTRUCTOR-->
                                <div class="wrapper">
                                    <div class="select-btn">        
                                        <span class="instructor_input">選択講師</span>
                                        <i class="uil uil-angle-down"></i>
                                    </div>
                                    <div class="content" style="position:absolute;">
                                        <div class="search">
                                            <i class="uil uil-search"></i>
                                            <input type="text" placeholder="Search">
                                        </div>
                                        <ul class="options">
                                        <?php
                                                $query = "SELECT name_ from users
                                                    WHERE userlevel ='2'
                                                    ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    $php_array = [];
                                                    foreach($result as $row)
                                                    {
                                                    //    echo "
                                                    //        <li>$row[name_]</li>
                                                    //    ";
                                                        $php_array[]=$row["name_"];
                                                    }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <!--SEARCH INSTRUCTOR-->
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td style="width:12%;">
                                <span>Ｂ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeBStart" id="datetimeRegularStart" value="">
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeBEnd" id="datetimeRegularEnd" value="">
                            </td>
                            <td style="width:5%; padding: 0;">
                            場所：
                            </td>
                            <td style=" width:15%;">
                                <input type="text" id="LocationRegular" name="LocationB" value="">
                            </td>
                            <td style="width:5%; padding: 0;">
                            講師：
                            </td>
                            <td>
                                <input type="text" id="trial_input" name="instructorBID" value="" hidden>
                            <!--SEARCH INSTRUCTOR-->
                                <div class="wrapper">
                                    <div class="select-btn">        
                                        <span class="instructor_input">選択講師</span>
                                        <i class="uil uil-angle-down"></i>
                                    </div>
                                    <div class="content" style="position:absolute;">
                                        <div class="search">
                                            <i class="uil uil-search"></i>
                                            <input type="text" placeholder="Search">
                                        </div>
                                        <ul class="options">
                                        <?php
                                                $query = "SELECT name_ from users
                                                    WHERE userlevel ='2'
                                                    ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    $php_array = [];
                                                    foreach($result as $row)
                                                    {
                                                    //    echo "
                                                    //        <li>$row[name_]</li>
                                                    //    ";
                                                        $php_array[]=$row["name_"];
                                                    }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <!--SEARCH INSTRUCTOR-->
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td style="width:12%;">
                                <span>Ｃ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeCStart" id="datetimeRegularStart" value="">
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeCEnd" id="datetimeRegularEnd" value="">
                            </td>
                            <td style="width:5%; padding: 0;">
                            場所：
                            </td>
                            <td style=" width:15%;">
                                <input type="text" id="CRegular" name="LocationC" value="">
                            </td>
                            <td style="width:5%; padding: 0;">
                            講師：
                            </td>
                            <td>
                                <input type="text" id="trial_input" name="instructorCID" value="" hidden>
                            <!--SEARCH INSTRUCTOR-->
                                <div class="wrapper">
                                    <div class="select-btn">        
                                        <span class="instructor_input">選択講師</span>
                                        <i class="uil uil-angle-down"></i>
                                    </div>
                                    <div class="content" style="position:absolute;">
                                        <div class="search">
                                            <i class="uil uil-search"></i>
                                            <input type="text" placeholder="Search">
                                        </div>
                                        <ul class="options">
                                        <?php
                                                $query = "SELECT name_ from users
                                                    WHERE userlevel ='2'
                                                    ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    $php_array = [];
                                                    foreach($result as $row)
                                                    {
                                                    //    echo "
                                                    //        <li>$row[name_]</li>
                                                    //    ";
                                                        $php_array[]=$row["name_"];
                                                    }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <!--SEARCH INSTRUCTOR-->
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td style="width:12%;">
                                <span>Ｄ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeDStart" id="datetimeRegularStart" value="" >
                            </td>
                            <td style="vertical-align:middle; width:17.5%;">
                                <input type="datetime-local" name="datetimeDEnd" id="datetimeRegularEnd" value="" >
                            </td>
                            <td style="width:5%; padding: 0;">
                            場所：
                            </td>
                            <td style=" width:15%;">
                                <input type="text" id="LocationD" name="LocationD" value="" >
                            </td>
                            <td style="width:5%; padding: 0;">
                            講師：
                            </td>
                            <td>
                                <input type="text" id="trial_input" name="instructorDID" value="" hidden>
                            <!--SEARCH INSTRUCTOR-->
                                <div class="wrapper">
                                    <div class="select-btn">        
                                        <span class="instructor_input">選択講師</span>
                                        <i class="uil uil-angle-down"></i>
                                    </div>
                                    <div class="content" style="position:absolute;">
                                        <div class="search">
                                            <i class="uil uil-search"></i>
                                            <input type="text" placeholder="Search">
                                        </div>
                                        <ul class="options">
                                        <?php
                                                $query = "SELECT name_ from users
                                                    WHERE userlevel ='2'
                                                    ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    $php_array = [];
                                                    foreach($result as $row)
                                                    {
                                                    //    echo "
                                                    //        <li>$row[name_]</li>
                                                    //    ";
                                                        $php_array[]=$row["name_"];
                                                    }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <!--SEARCH INSTRUCTOR-->
                            </td>
                        </tr>
                        
                    </table>
                </div>
                <div id="categoryDIV" class="categoryDIV">
                    <caption><b>区分</b></caption>
                    <table id="categoryTable" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tbody>
                            <tr>
                          <!--  Quality
                                <td style="width:25%">
                                    <input type="radio" id="categoryQuality" name="category" value="品質" checked>
                                    <label for="categoryQuality">品質</label>
                                </td> 
                                <td style="width:25%">
                                    <input type="radio" 
                                    id="categoryEnvironment"
                                    name="category" 
                                    value="環境">
                                    <label for="categoryEnvironment">環境</label> Environment
                                </td>
                                <td style="width:25%">
                                    <input type="radio" 
                                    id="categorySafetyAndHygiene" 
                                    name="category" 
                                    value="安全衛生">
                                    <label for="categorySafetyAndHygiene">安全衛生</label> Safety and Hygiene
                                </td>
                                <td style="width:25%">
                                    <div>
                                        <input type="radio" 
                                        id="categoryOther" 
                                        name="category" 
                                        value="Other">
                                        <label for="categoryOther">その他</label>
                                        <input type="text" 
                                        id="categoryOtherManual" 
                                        value="" 
                                        name="category_other_manual" 
                                        placeholder="PLEASE SPECIFY"
                                        style="width:70%">
                                    </div>
                                </td> -->

                                <td style="width:25%">
                                    <input type="checkbox" id="categoryQuality"
                                    
                                    name="category[]"
                                    value="1"> <!--Quality-->
                                    <label for="categoryQuality">品質</label>
                                </td> 

                                <td style="width:25%">
                                    <input type="checkbox" 
                                    id="categoryEnvironment"
                                    name="category[]" 
                                    value="2">
                                    <label for="categoryEnvironment">環境</label> <!--Environment-->
                                </td>

                                <td style="width:25%">
                                    <input type="checkbox" 
                                    id="categorySafetyAndHygiene" 
                                    name="category[]" 
                                    value="3">
                                    <label for="categorySafetyAndHygiene">安全衛生</label> <!--Safety and Hygiene-->
                                </td>

                                <td style="width:25%">
                                    <div>
                                        <input type="checkbox" 
                                        id="categoryOther" 
                                        name="category[]" 
                                        value="4">
                                        <label for="categoryOther">その他</label>
                                        <input type="text" 
                                        id="categoryOtherManual" 
                                        value="" 
                                        name="category_others_manual" 
                                        placeholder="PLEASE SPECIFY"
                                        style="width:70%">
                                    </div>
                                </td> 


                            </tr>
                        </tbody>
                    </table>        
                </div>
                <div id="purposeDIV" class="purposeDIV">
                    <caption><b>目的、対象者</b></caption>
                    <table id="purposeTable" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="1" style="width:10%">目的：</td>
                            <td colspan="4"><input type="text" name="purposeID" id="purposeID" value="<?php /*echo $purpose_prev; */?>" style="width:96%" required></td>
                        </tr>
                        <tr>
                            <td colspan ="1" style="width:10%">対象者：</td>
                            <td style ="50%"><input type="text" name="audienceID" id="audienceID" value="<?php echo $audience_prev;?>" style="width:92%" required></td>
                            <td colspan ="1" style="width:2.5%">名:</td>
                            <td style="width:2.5%"><span class="jqValue" id="jqValue"></span><input type="text" id="count_value" name="count_value" hidden class="count_value" value=""></td>
                            <td style="width:35%"></td>
                        </tr>
                    </table>
                </div>
                <div id="participantsDIV" class="participantsDIV">
                    <caption><b>受講者（製造）</b></caption>        
                    <table id="participantsTable" border="1" class="table table-hover rounded-3 table-sm overflow-hidden participantsT">
                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:10%; vertical-align:middle;height:40px;"><input type="checkbox"  id="select_all" onClick="toggle(this)" onchange="count()" style="vertical-align:middle;">すべて選択</th>
                                <th style="width:18%; vertical-align:middle;height:40px;">GID</th>
                                <th style="width:18%; vertical-align:middle;height:40px;">名前</th>
                                <th style="width:18%; vertical-align:middle;height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">Team</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT distinct(shift_description) FROM users
                                                    INNER JOIN shift ON users.shift_id = shift.shift_id
                                                    WHERE group_ = '$group_'
                                                    ORDER BY shift.shift_description ASC;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" class="common_selector shift" value="
                                                        <?php echo $row["shift_description"];
                                                        ?>
                                                        "> <?php echo $row["shift_description"];
                                                        ?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?>        
                                        </ul>  
                                </th>
                                <th style="width:18%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">工程</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(department_name) FROM users
                                                    INNER JOIN department ON users.department_id = department.department_id
                                                    WHERE group_ = '$group_'
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" class="common_selector process" value="
                                                        <?php echo $row["department_name"];
                                                        ?>
                                                        "> <?php echo $row["department_name"];
                                                        ?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>  
                                </th>
                                <th style="width:18%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">Building</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(building) FROM users
                                                    WHERE group_ = '$group_'
                                                    ORDER by building ASC
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" class="common_selector building" value="
                                                        <?php echo $row["building"];
                                                        ?>
                                                        "> <?php echo $row["building"];?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>   
                                </th> 
                            </tr>
                        </thead>
                        <tbody id="post_list" class="participants_tbody">
                        </tbody>
                    
                    </table>          
                </div> 
                <div id="contentsDIV" class="contentsDIV">
                <caption><b>内容</b></caption>
                    <table id="contentsTable" border="1" class="contentsT">
                        <tr>
                            <td><textarea type="text" name="contentsID" id="contentsID" value="" class="contentsInput" rows="3" required><?php /* echo $contents_prev; */?></textarea></td>
                        </tr>
                    </table>
                </div>
                <div id="usageDIV">
                <caption><b>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</b></caption>
                    <table id="usageTable" border="1" class="usageT">
                        <tr>
                            <td colspan="4"><textarea type="text" name="usageID" id="usageID" value="" rows="3" class="usageInput" required><?php /*echo $usage_id_prev; */?></textarea></td>
                        </tr>
                        <tr>
                            
                            <td style="justify-tems:center; width:45%;">訓練資料を追加(任意):<input type="file" name="file[]" multiple ></td>
                        
                            <td style="width: 60%;"></td>
                        </tr>
                    </table>
                </div>
                <div id="confirmation_by" class="confirmation_by_div">
                    <caption style="text-align:center;"><b>教育効果の確認方法、確認予定日</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" name="confirmation_by" id="confirmation_by_id" value="インタビュー式による確認" style="width:100%" required></td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width:25%; vertical-align:middle;">最終確認予定日：</td>
                            <td colspan="1" style="width:25%"><input type="datetime-local" name="confirmation_date" id="confirmation_date_id" value="" style="width:90%" required></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                        </tr>
                    </table>
                </div>
                <div id="checker_comment_regular" class="checker_comment_regular_div">
                    <caption style="text-align:center;"><b>教育効果の確認結果</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="1" style="width:10%">日勤者：</td>
                            <td colspan="2" style="width:65%"><input type="text" name="checker_people_regular" id="checker_people_regular" value="" style="width:100%"></td>
                            <td colspan="1" style="width:25%"><input type="datetime-local" name="checker_date_regular" id="checker_date_regular" value="" style="width:90%"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" name="checker_comment_regular" id="checker_comment_regular"
                             value="上記の人にインタビューを実施し、理解できたことを確認できました。" style="width:100%"></td>
                        </tr>
                    </table>
                </div>
                    <button type="submit" class = "btn-update" style="text-decoration:none; margin-right:20px;" id="checkBtn"><span>送信</span></button>
            </form>   
            </div>
        </div> <!--main-->
    </div> <!--mainwrapper-->
</div> <!--full-->   

<!-----SCRIPT------>

<script type="text/javascript">


/** Search Instructor **/
const wrapper = document.querySelector(".wrapper"),
selectBtn = wrapper.querySelector(".select-btn"),
searchInp = wrapper.querySelector("input");
const options = wrapper.querySelector(".options");

//array of instructors inserted into javascript array from PHP
var jArray = <?php echo json_encode($php_array); ?>;

let instructors =jArray;
    
function add_instructor() {
    options.innerHTML = "";
    instructors.forEach(instructor => { 
        // adding each instructor inside li and inserting all li inside options tag
        let li = `<li onclick ="update_name(this)">${instructor}</li>`;
        options.insertAdjacentHTML("beforeend", li);
    });
}

add_instructor();

function update_name(selectedLi) {
    searchInp.value = "";
    add_instructor();
    wrapper.classList.remove("active");
    selectBtn.firstElementChild.innerText = selectedLi.innerText;
    document.getElementById("trial_input").value =selectedLi.innerText;
}

searchInp.addEventListener("keyup", () => {
    let arr =[];
    let searchedVal = searchInp.value.toLowerCase();
    // returning all instructors from array which are start with user searched value
    // and mapping returned country with li and joining them
    arr = instructors.filter(data => {
        return data.toLowerCase().startsWith(searchedVal);
    }).map(data => `<li onclick ="update_name(this)">${data}</li>`).join("");
    options.innerHTML = arr ?  arr : `<p> Instructor not found! </p>`;
});

selectBtn.addEventListener("click", () => {
wrapper.classList.toggle("active");
});

/**Participants **/

$(document).ready(function() {

    $('#checkBtn').click(function() {
        checked = $('input[name="GIDcheck[]"]:checked').length;

        if(!checked) {
            alert("You must select at least one participant");
            return false;
        }
    });

    filter_data();
    function filter_data() {
      //$('#post_list').html();
      var action = 'fetch_data';
      var shift = get_filter('shift');
      var process = get_filter('process');
      var building = get_filter('building');

      $.ajax({
          url: "includes/fetch_data.inc.php",
          method: "POST",
          data: {action:action,shift:shift,process:process,building:building},
          success:function(data){
            $('#post_list').html(data);
          }
      });
  }

  function get_filter(class_name)
  {
    var filter = [];
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });

    return filter;
  }

  $('.common_selector').click(function(){
      filter_data();
  });
});




function toggle(source) {
    checkboxes = document.getElementsByName('GIDcheck[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {    
    checkboxes[i].checked = source.checked;  
}
}

function count() {
var checkedboxes = $('input[name="GIDcheck[]"]:checked').length;
$('.jqValue').html(checkedboxes);

document.getElementById("count_value").value = checkedboxes;

}


</script>

</body>
</html>

