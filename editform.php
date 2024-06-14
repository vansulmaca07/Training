<?php
    include_once 'navigation.php'; 
    
    $category_array = array ();
    $category_array = $_SESSION["category"];


    $creation_department = $_SESSION["creation_department"];
    $department = $_SESSION["department"];

    $group_ = $_SESSION["group_"];

    $training_id = $_SESSION["training_id"];




?>
         <!-----------REGISTRATION FORM----------->
         
         <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <div class="main" id="main">
            <div class="scroll" id="div-scroll">
                <div class="new-form-header"  style="position:absolute;">
                    <a href="pdf_preview.php?<?php echo$_SESSION['training_id'];?>" target="_blank" class="btn-pdf" ><span style="">PDF 表示&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-filetype-pdf"></i></span></a>
                    <?php 
                        if (isset($_GET["error"])) {
                                if ($_GET["error"] == "training_id_duplicate") {
                                echo "
                               
                                <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' role='alert'>
                                    DUPLICATE TRAINING ID!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>      
                                "
                                ;                
                                }
                        }
                        ?>
                </div>
            <form action="includes/update_form.inc.php" method="post">
            <div  id="creationdepartment">
                <h2>作成部署: 製造部
                <input type="text" hidden value="<?php echo $_SESSION["training_id"]; ?>"
                name ="training_id" >
                <input type="text"
                style="width:15%"
                hidden
                name="departmentID"
                id="departmentID"
                value="<?php echo $_SESSION["department_name"]; ?>"
                required>
                </h2>
            </div> 
            <div id="mainrecord">
                    <table id="mainrecordTable" border="1" class="mainrecordT">
                    <tbody>
                    <tr style="width:100%">
                    <td style="width:50%">
                    <span>名称：</span>
                    <input type="text"
                     name="educationID"
                     id="educationID"
                     value="<?php echo $_SESSION["training_name"]; ?>"
                     style="width:90%"
                     required
                     class="input-main-form"
                     <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                     ?>
                     >
                    </td>
                    <td style="width:10%">
                    <span>工程： <?php echo $_SESSION["process_prefix"];?></span>
                    <input hidden name="process_prefix" id="process_prefix_id"
                    value="<?php echo $_SESSION["process_prefix"]; ?>" class="input-main-form"
                    
                    >
                    </td>
                    <td style="width:10%">
                    <input type="text" value="<?php echo $_SESSION["process_suffix"];?>" name="process_suffix" id="process_suffix_id"
                    style="width:50%" class="input-main-form"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                     ?>
                    >
                    </td>
                    <td style="width:15%">
                        <input type='radio' 
                        <?php
                        if($department !== $creation_department) {
                            echo "disabled";
                        }
                        ?>
                        id='trainingLocInternal' name='trainingLoc' value='1'
                        <?php
                        if($_SESSION["area"]=='1') {
                        echo "checked"; 
                        }
                        ?>
                        >
                        <label for='trainingLocInternal'>社内</label>
                        </td>
                        <td style='width:15%'>
                        <input type='radio' 
                        <?php
                        if($department !== $creation_department) {
                            echo "disabled";
                        }
                        ?>
                        id='trainingLocExternal' name='trainingLoc' value='2'
                        <?php
                        if($_SESSION["area"]=='2') {
                        echo "checked"; 
                        }
                        ?>
                        >
                        <label for='trainingLocExternal'>社外</label> 
                           
                    </td>
                    
                    </tr>
                    </tbody>
                    </table>
                    <table id="mainrecordTable2" border="1" class="mainrecordT2">
                    <tr>
                    <td>
                    <span>日勤者実施日時：</span>
                    <td>
                    <input type="datetime-local"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="datetimeRegularStart" id="datetimeRegularStart" value="<?php echo $_SESSION["start_time_regular"]; ?>" required class="input-main-form">
                    </td>
                    <td> 
                    <input type="datetime-local"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="datetimeRegularEnd" id="datetimeRegularEnd" value="<?php echo $_SESSION["end_time_regular"]; ?>" required class="input-main-form">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationRegular" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="LocationRegular" value="<?php echo $_SESSION["location_regular"]; ?>" required class="input-main-form">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorRegularID"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="instructorRegularID" value="<?php echo $_SESSION["instructor_regular"]; ?>" required class="input-main-form">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ａ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeAStart" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    id="datetimeAStart" class="input-main-form">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeAEnd"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    id="datetimeAEnd" class="input-main-form">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationA" name="LocationA"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    value="" class="input-main-form">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorAID" name="instructorAID"
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    value="" class="input-main-form">
                    </td> 
                    </tr>
                    <tr>
                    <td>
                    <span>Ｂ班実施日時：</span>
                    <td>
                    <input
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="datetime-local" name="datetimeBStart" id="datetimeBStart" class="input-main-form">
                    </td>
                    <td>
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="datetime-local" name="datetimeBEnd" id="datetimeBEnd" class="input-main-form">
                    </td>
                    <td>場所：
                    <input
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" id="LocationB" name="LocationB" value="" class="input-main-form">
                    </td>
                    <td>講師：
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" id="instructorBID" name="instructorBID" value="" class="input-main-form">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｃ班実施日時：</span>
                    <td>
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="datetime-local" name="datetimeCStart" id="datetimeCStart" class="input-main-form">
                    </td>
                    <td>
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="datetime-local" name="datetimeCEnd" id="datetimeCEnd" class="input-main-form">
                    </td>
                    <td>場所：
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" id="LocationC" name="LocationC" value="" class="input-main-form">
                    </td>
                    <td>講師：
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" id="instructorCID" name="instructorCID" value="" class="input-main-form">
                    </td>
                     </tr>
                    <tr>
                    <td>
                    <span>Ｄ班実施日時：</span>
                    <td>
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="datetime-local" name="datetimeDStart" id="datetimeDStart" class="input-main-form">
                    </td>
                    <td>
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="datetime-local" name="datetimeDEnd" id="datetimeDEnd" class="input-main-form">
                    </td>
                    <td>場所：
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" id="LocationD" name="LocationD" value="" class="input-main-form">
                    </td>
                    <td>講師：
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" id="instructorDID" name="instructorDID" value="" class="input-main-form">
                    </td>
                    </tr>
                    </tbody>
                    </table>
            </div>
            <div id="categoryDIV" class="categoryDIV">
                     <caption>区分</caption>
                    <table id="categoryTable" border="1" class="categoryT">
                    <tbody>
                    <tr>
                    

                    <td>
                    <input
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?> 
                    type="checkbox" id="categoryQuality"  name="category[]" value="1" <?php if(in_array(1,$category_array)) {echo 'checked';}?>> 
                    <label for="categoryQuality">品質</label>
                    </td>

                    <td style="width:25%">
                    <input type="checkbox" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    id="categoryEnvironment"
                    name="category[]" 
                    value="2"
                    <?php if(in_array(2,$category_array)) {echo 'checked';}?>>
                    <label for="categoryEnvironment">環境</label> <!--Environment-->
                    </td>

                    <td style="width:25%">
                    <input type="checkbox" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    id="categorySafetyAndHygiene" 
                    name="category[]" 
                    value="3"
                    <?php if(in_array(3,$category_array)) {echo 'checked';}?>>
                    <label for="categorySafetyAndHygiene">安全衛生</label> <!--Safety and Hygiene-->
                    </td>

                    <td style="width:25%">
                    <div>
                    <input type="checkbox" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    id="categoryOther" 
                    name="category[]" 
                    value="4"
                    <?php if(in_array(4,$category_array)) {echo 'checked';}?>>
                    <label for="categoryOther">その他</label>
                    <input type="text" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    id="categoryOtherManual" 
                    value="<?php if ($_SESSION["category_others"]==='1'){ echo $_SESSION["category_others_manual"];}?>" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="categoryOtherManual" 
                    placeholder="PLEASE SPECIFY"
                    style="width:70%"
                    class="input-main-form">
                    </div>
                    </td> 

                    </select>
                    </tr>
                    </tbody>
                    </table>        
            </div>
            <div id="purposeDIV" class="purposeDIV">
                     <caption>目的、対象者</caption>
                    <table id="purposeTable" border="1" class="purposeT">
                    <tr>
                    <td>目的：</td>
                    <td colspan="3">
                        <input type="text" 
                        <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="purposeID" id="purposeID" class="input-main-form" value="<?php echo $_SESSION["purpose"]; ?>" style="width:96%" required></td>
                    </tr>
                    <tr>
                    <td>対象者：</td>
                    <td><input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    type="text" name="audienceID" id="audienceID" class="input-main-form" value="<?php echo $_SESSION["audience"]; ?>" style="width:90%" required></td>
                    <td>名:</td>
                    <td style="width:50%; text-align:left;"><span id="count_value" class="count_value" style="text-align:left;"></span>
                    <input 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    hidden type="text" value="" id="count_value_input" name="count_value_input"></td>

                    </tr>
                    </table>
            </div>
            <div id="participantsDIV" class="participantsDIV">
                    <caption><b>受講者（製造）</b></caption>        
                    <table id="participantsTable" style="font-size: 14px;" class="table table-sm table-hover table-bordered rounded-3 overflow-hidden participantsT">

                    
                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:15%; vertical-align:middle;height:40px;">GID</th>
                                <th style="width:20%; vertical-align:middle;height:40px;">名前</th>
                                <th style="width:10%; vertical-align:middle;height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">Team</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                              /*  $query = "SELECT distinct(shift_description) FROM users
                                                    INNER JOIN shift ON users.shift_id = shift.shift_id
                                                    WHERE group_ = '$group_'
                                                    ORDER BY shift.shift_description ASC;"; */
                                                    $query_shift = "SELECT distinct(shift_description) FROM attendance
                                                    INNER JOIN users on attendance.GIDh = users.GID
                                                    INNER JOIN shift ON users.shift_id = shift.shift_id
                                                    WHERE training_id = :training_id
                                                    ORDER BY shift.shift_description ASC;";

                                                $stmt_shift = $pdo->prepare($query_shift);
                                                $stmt_shift->bindParam(":training_id",$training_id);
                                                $stmt_shift->execute();
                                                $result = $stmt_shift->fetchAll();
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
                                <th style="width:15%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">工程</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                               /* $query = "SELECT DISTINCT(department_name) FROM users
                                                    INNER JOIN department ON users.department_id = department.department_id
                                                    WHERE group_ = '$group_'
                                                    ;";*/
                                                $query = "SELECT DISTINCT(department_name) FROM attendance
                                                    INNER JOIN users on users.GID = attendance.GIDh
                                                    INNER JOIN department ON users.department_id = department.department_id
                                                    WHERE training_id = :training_id
                                                    "
                                                    ;

                                                $stmt = $pdo->prepare($query);
                                                $stmt->bindParam("training_id",$training_id);
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
                                <th style="width:15%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">Building</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                               /* $query = "SELECT DISTINCT(building) FROM users
                                                    WHERE group_ = '$group_'
                                                    ORDER by building ASC
                                                    ;"; */
                                                $query = "SELECT DISTINCT(building) FROM attendance
                                                    INNER JOIN users on users.GID = attendance.GIDh
                                                    
                                                    WHERE training_id = :training_id";   

                                                $stmt = $pdo->prepare($query);
                                                $stmt->bindParam("training_id",$training_id);
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
                                <th style="width:12.5%; vertical-align:middle; height:40px;">
                                認定
                                </th>
                                <th style="width:12.5%; vertical-align:middle; height:40px;">
                                <i class="bi bi-person-dash"></i>
                                </th> 
                            </tr>
                        </thead>
                        <tbody id="post_list" class="participants_tbody">
                        </tbody>
                    </table>
                    <div id="success"></div>
                      
            </div>
            <div style="width:100%; height: 60px;">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:left;" <?php if($department !== $creation_department) {
                        echo "disabled";
                     }?>>
                    研修生を追加<i class="bi bi-person-fill-add"></i>
                    </button>   
                    
            </div>

            <div class="reference_material_div">
                <table class="table table-bordered table-hover rounded-3 overflow-hidden reference_material_T">
                    <thead class="table text-center theadstyle reference_material_thead" style="width: 98.5%;">
                        <th style="width:10%;">No.</th>
                        <th style="width:65%;">Reference Materials</th>
                        <th style="width:12.5%;">Download</th>
                        <th style="width:12.5%;">Delete</th>
                    </thead>
                    <tbody>
                    <?php
                        $query_materials = "SELECT 
                                    file_id, 
                                    file_name, 
                                    file_ext, 
                                    training_id, 
                                    active_status, 
                                    file_path, 
                                    file_path_main_directory, 
                                    main_directory_id, 
                                    main_storage_directory 
                                FROM file_Storage
	                            INNER JOIN
		                            file_storage_main ON file_storage_main.main_directory_id = file_storage.file_path_main_directory
	                            WHERE training_id = '$training_id'";
                                        
                        $stmt_materials = $pdo->prepare($query_materials);
                        $stmt_materials->execute();

                        $result_materials = $stmt_materials->fetchAll();

                        $index = 0;
               
                        foreach ($result_materials as $materials) {
  
                            $main_directory = $materials["main_storage_directory"];
                            $file_path = $materials["file_path"];
                            $file_name = $materials["file_name"];
                            $file_ext = $materials["file_ext"];
                            $file_id = $materials["file_id"];
                            
                            $ip_add = $_SERVER['HTTP_HOST'];
                            $http = "http://";
                           
                            $full_path = $main_directory .  $file_path . $file_name . "." . $file_ext;
                            echo "<tr>
                                    <td style='width:10.2%;'>";
                            $index = $index +1;
                            echo $index;     
                            echo "</td>";
                            echo "<td style='width:66%;'>$materials[file_name].$materials[file_ext]</td>
                             <td style='width:12.8%;'><a href = 'download.php?file_id=$file_id' class='btn btn-primary' style ='vertical-align:middle;'><i style='vertical-align: middle;' class='bi bi-download'></i></a></td>         
                            <td><button type ='button' value='$materials[file_id]' class ='btn btn-danger'>削除<i class='bi bi-x-circle'></i></button></td>
                            </tr>
                           ";
                           
                        }
                    ?>
                    </tbody>
                </table>
            </div>
  
            <!--
            <div class="upload_div">
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Upload Additional Files</label>
                    <input class="form-control" type="file" id="formFileMultiple" name="file[]" style="width:50%; background-color:lightyellow;" multiple>
                </div>
            </div> -->

            <div style="width:100%; height: 60px;">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:left;" <?php if($department !== $creation_department) {
                        echo "disabled";
                     }?>>
                    Upload Additional Files<i class="bi bi-person-fill-add"></i>
                    </button>   
                    
            </div>
            
            <div id="contentsDIV" class="contentsDIV">
            <caption>内容</caption>
                <table id="contentsTable" border="1" class="contentsT">
                
                <tr>
                <td><textarea type="text"
                <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                ?>
                name="contentsID" id="contentsID" value="" class="contentsInput" rows="3" required><?php echo  $_SESSION["contents"]; ?></textarea></td>
                </tr>
                </table>
            </div>
            <div id="usageDIV">
                    <caption>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</caption>
                    <table id="usageTable" border="1" class="usageT">
                    <tr>
                    <td><textarea type="text" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="usageID" id="usageID" value="" rows="3" class="usageInput" required><?php echo  $_SESSION["usage_id"]; ?></textarea></td>
                    </tr>
                </table>
            </div>
            <div id="confirmation_by" class="confirmation_by_div">
                    <caption style="text-align:center;"><b>教育効果の確認方法、確認予定日</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" 
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                        class="input-main-form" name="confirmation_by" id="confirmation_by_id" value="<?php echo  $_SESSION["confirmation_by"]; ?>" style="width:100%" required></td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width:25%; vertical-align:middle;">最終確認予定日：</td>
                            <td colspan="1" style="width:25%"><input 
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                             }
                            ?>
                            type="datetime-local" class="input-main-form" name="confirmation_date" id="confirmation_date_id" value="<?php echo  $_SESSION["confirmation_date"]; ?>" style="width:90%" required></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                        </tr>
                    </table>
                </div>
            <div id="checker_comment_regular" class="checker_comment_regular_div" style="overflow-y: visible">
                <caption style="text-align:center;"><b>教育効果の確認結果</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="1" style="width:15%">日勤者：</td>
                            <td colspan="2" style="width:65%"><input type="text" class="input-main-form" name="checker_people_regular"
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                            id="checker_people_regular"  
                            value="<?php echo  $_SESSION["checker_people_regular"]; ?>" style="width:100%"
                            <?php
                                    if($_SESSION["status_id"] === '1') {
                                        echo "disabled";
                                    }
                            ?>></td>
                            <td colspan="1" style="width:25%">
                            <input 
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                            class="input-main-form" type="datetime-local" name="checker_date_regular" id="checker_date_regular" value="<?php echo  $_SESSION["checker_date_regular"]; ?>" style="width:90%"
                            <?php
                                    if($_SESSION["status_id"] === '1') {
                                        echo "disabled";
                                    }
                            ?>></td>
                           
                        </tr>
                        <tr>
                            <td colspan="4" style="width:100%">
                            <input 
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                            class="input-main-form" type="text" name="checker_comment_regular" id="checker_comment_regular" value="<?php echo  $_SESSION["checker_comment_regular"]; ?>" style="width:100%"></td>
                        </tr>
                    </table>
            </div>
            
          
               
            <!--------------------------------------->
            </div>
            <div class="row">
                <div class="col">
                <button type="submit" class = "btn-update" style="text-decoration:none; float;left;<?php if($department !== $creation_department) {
                        echo "display:none;";
                     }
                ?>
                ">
                <span>UPDATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-clockwise"></i></span></button> 
                </form>                  
                </div>
                <div class="col">
                    
                  
                    <a href="newform.php?training_id=<?php echo$_SESSION['training_id'];?>"  class="btn-update" ><span style="">コピー&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-copy"></i></span></a>
                                            
                </div>
            </div>
             <!-- Modal -->
             <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">研修生を追加<i class="bi bi-person-fill-add"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table id="participantsTable" border="1" class="table table-hover rounded-3 table-sm overflow-hidden participantsT">
                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:10%; vertical-align:middle;height:40px;"><input type="checkbox"  id="select_all" onClick="toggle(this)" onchange="count()" style="vertical-align:middle;">すべて選択</th>
                                <th style="width:18%; vertical-align:middle;height:40px;">GID
                                <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle"></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="list-group-item">
                                                    <div class="form-group">
                                                        <input type="text" name="GID_search" id="GID_search" class="form-control" placeholder="Search GID">
                                                    </div>
                                                </div>              
                                            </ul> 
                                </th>
                                <th style="width:18%; vertical-align:middle;height:40px;">名前</th>
                                <th style="width:18%; vertical-align:middle;height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">Team</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <?php
                                                $query = "SELECT distinct(shift_description) FROM users
                                                    INNER JOIN shift ON users.shift_id = shift.shift_id
                                                    
                                                    ORDER BY shift.shift_description ASC;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" class="common_selector_add shift_add" value="
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
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="max-height: 300px; overflow-y:scroll">
                                        <?php
                                                $query = "SELECT DISTINCT(department_name) FROM users
                                                    INNER JOIN department ON users.department_id = department.department_id
                                                    
                                                    ";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox"
                                                        <?php
                                                        if ($row["department_name"] === $_SESSION["department_name"]) {
                                                            echo "checked";
                                                        }
                                                        ?>
                                                        class="common_selector_add process_add" 
                                                        value="<?php echo $row["department_name"];
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
                                                        
                                                        ORDER by building ASC
                                                        ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                    {
                                                ?>
                                                    <div class="list-group-item checkbox">
                                                        <label><input type="checkbox" class="common_selector_add building_add" value="
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
                        <form id="participants_form" method="POST">
                        <tbody id="post_list_add" class="participants_tbody">
                        </tbody>
                            
                    </table> 
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" type="submit" name="submit" id="submit_add" value="submit_add" class="btn btn-primary" data-bs-dismiss="modal">ADD</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            </div>
            
        </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

<script type="text/javascript">

    
/**Participants **/

function judgement_update(value,GID) {
    alert(GID);
}


$(document).ready(function() {

    filter_data();

    function filter_data() {

    $('#post_list').html();
    var action = 'fetch_data';
    var shift = get_filter('shift');
    var process = get_filter('process');
    var building = get_filter('building');
    
    $.ajax({
        url: "includes/fetch_data_edit_attendance.inc.php",
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
    
    function get_filter_name(class_name)
    {
    var filter = [];
    $('.'+class_name).each(function(){
      filter.push($(this).val());
    });

    return filter;
    }

    $('.common_selector').click(function(){
        filter_data();

    });

    $("select").attr("disabled", true);

    //add participants

    $('.common_selector_add').click(function(){
        filter_add_data();

    });

    $('#GID_search').keyup(function(event){
    event.preventDefault();
    filter_add_data();

    });

    $('#name_search').keyup(function(event){
    event.preventDefault();
    filter_add_data();

    });



    filter_add_data();
    function filter_add_data() {
      //$('#post_list').html();
      var action = 'fetch_data';
      var shift_add = get_filter('shift_add');
      var process_add = get_filter('process_add');
      var building_add = get_filter('building_add');
      var GID_search = $('#GID_search').val();
      var name_search = $('#name_search').val();

      $.ajax({
          url: "includes/fetch_data_add_participants.inc.php",
          method: "POST",
          data: {action:action,shift_add:shift_add,process_add:process_add,building_add:building_add,GID_search:GID_search},
          success:function(data){
            $('#post_list_add').html(data);
          }
      });
    }

    $('#submit_add').click(function(){
        submit_data();

    });

    function submit_data(){

        var action = 'fetch_data';
        var GIDcheck_add = get_filter('GIDcheck'); 
        var GIDname_add = get_filter_name('GIDname');
        var name_add = get_filter_name('name_');
        var department_name_add = get_filter_name('department_name');
      
        console.log(GIDcheck_add);
        console.log(GIDname_add);
        console.log(name_add);
        console.log(department_name_add);
    
    $.ajax({
          url: "includes/add_participants.inc.php",
          method: "POST",
          data: {GIDcheck_add:GIDcheck_add,
            GIDname_add:GIDname_add,
            name_add:name_add,
            department_name_add:department_name_add},
          success:function(data){ 
            console.log("success");
            filter_data();
            filter_add_data();
          },
          error:function(data){
            console.log("error");
          }
    
      }); 

    }

    var fired_button;

    $('#participantsTable tbody').on('click', 'button', function(){
        
        fired_button = $(this).val();
        delete_data();
        
    });

    function delete_data() {
        var GID_delete = fired_button;

        $.ajax({
          url: "includes/delete_trainee.inc.php",
          method: "POST",
          data: {GID_delete:GID_delete},
          success:function(data){ 
            filter_data();
            filter_add_data();
          },
          error:function(data){
            console.log("error");
          }
    
      }); 

    }

    var download_button;
    $('button_download').click(function() {
    download_button = $(this).val();
    
    

    alert(download_button);
    //console.log(fired_button);
    });

      

    


 
});



  

function toggle(source) {
    checkboxes = document.getElementsByName('GIDcheck_add[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {    
    checkboxes[i].checked = source.checked;  
}
}

function count() {
var checkedboxes = $('input[name="GIDcheck[]"]:checked').length;
$('.jqValue').html(checkedboxes);
}

setTimeout(function () {
    var x = document.getElementById("participantsTable").rows.length;
document.getElementById('count_value').innerHTML = x-1;
document.getElementById('count_value_input').value = x-1;

}, 500)

console.log('<?php echo $_SESSION["status_id"];?>');

</script>



</body>
</html>
