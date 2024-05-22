<?php
    include_once 'navigation.php';  

?>
         <!-----------REGISTRATION FORM----------->
         <script type="text/javascript" src="navigation.js"></script>
         <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <div class="main" id="main">
            <div class="scroll" id="div-scroll">
                <div class="new-form-header"  style="position:absolute;">
                    <a href="pdf_preview.php" target="_blank" class="btn-pdf" ><span style="">PDF 表示&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-filetype-pdf"></i></span></a>
                </div>
            <form action="includes/update_form.inc.php" method="post">
            <div  id="creationdepartment">
                <h2>作成部署: <?php echo $_SESSION["department_name"];?>
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
                     required>
                    </td>
                    <td style="width:10%">
                    <span>工程： <?php echo $_SESSION["process_prefix"];?></span>
                    <input hidden name="process_prefix" id="process_prefix_id"
                    value="<?php echo $_SESSION["process_prefix"]; ?>">
                    </td>
                    <td style="width:10%">
                    <input type="text" value="<?php echo $_SESSION["process_suffix"];?>" name="process_suffix" id="process_suffix_id"
                    style="width:50%">
                    </td>
                    <td style="width:15%">

                    <?php
                    
                    if($_SESSION["area"]=='1') {
                    echo "
                    <input type='radio' id='trainingLocInternal' name='trainingLoc' value='1' checked>
                    <label for='trainingLocInternal'>社内</label>
                    </td>
                    <td style='width:15%''>
                    <input type='radio' id='trainingLocExternal' name='trainingLoc' value='2'>
                    <label for='trainingLocExternal'>社外</label>
                    ";
                    }
                    else if ($_SESSION["area"]=='2') {
                        echo "
                        <input type='radio' id='trainingLocInternal' name='trainingLoc' value='1'>
                        <label for='trainingLocInternal'>社内</label>
                        </td>
                        <td style='width:15%''>
                        <input type='radio' id='trainingLocExternal' name='trainingLoc' value='2' checked>
                        <label for='trainingLocExternal'>社外</label>
                    ";
                    }
                    ?>
                    </td>
                    
                    </tr>
                    </tbody>
                    </table>
                    <table id="mainrecordTable2" border="1" class="mainrecordT2">
                    <tr>
                    <td>
                    <span>日勤者実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeRegularStart" id="datetimeRegularStart" value="<?php echo $_SESSION["start_time_regular"]; ?>" required>
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeRegularEnd" id="datetimeRegularEnd" value="<?php echo $_SESSION["end_time_regular"]; ?>" required>
                    </td>
                    <td>場所：
                    <input type="text" id="LocationRegular" name="LocationRegular" value="<?php echo $_SESSION["location_regular"]; ?>" required>
                    </td>
                    <td>講師：
                    <input type="text" id="instructorRegularID" name="instructorRegularID" value="<?php echo $_SESSION["instructor_regular"]; ?>" required>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ａ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeAStart" id="datetimeAStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeAEnd" id="datetimeAEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationA" name="LocationA" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorAID" name="instructorAID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｂ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeBStart" id="datetimeBStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeBEnd" id="datetimeBEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationB" name="LocationB" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorBID" name="instructorBID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｃ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeCStart" id="datetimeCStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeCEnd" id="datetimeCEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationC" name="LocationC" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorCID" name="instructorCID" value="">
                    </td>
                     </tr>
                    <tr>
                    <td>
                    <span>Ｄ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeDStart" id="datetimeDStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeDEnd" id="datetimeDEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationD" name="LocationD" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorDID" name="instructorDID" value="">
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
                    <!--    
                    <td style="width:25%">
                    <input type="radio" id="categoryQuality" name="category" value="品質" <?php if ($_SESSION["category"]=='品質'){ echo 'checked';}?>> <!--Quality
                    <label for="categoryQuality">品質</label>
                    </td>
                    <td style="width:25%">
                    <input type="radio" 
                    id="categoryEnvironment"
                    name="category" 
                    value="環境"
                    <?php /* if ($_SESSION["category"]=='環境'){ echo 'checked';} */?>>
                    <label for="categoryEnvironment">環境</label> Environment
                    </td>
                    <td style="width:25%">
                    <input type="radio" 
                    id="categorySafetyAndHygiene" 
                    name="category" 
                    value="安全衛生"
                    <?php /*if ($_SESSION["category"]=='安全衛生'){ echo 'checked';} */?>>
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
                    name="categoryOtherManual" 
                    placeholder="PLEASE SPECIFY"
                    style="width:70%">
                    </div>
                    </td> 
                -->

                    <td>
                    <input type="checkbox" id="categoryQuality" name="category_quality" value="1" <?php if ($_SESSION["category_quality"]==='1'){ echo 'checked';}?>> 
                    <label for="categoryQuality">品質</label>
                    </td>

                    <td style="width:25%">
                    <input type="checkbox" 
                    id="categoryEnvironment"
                    name="category_environment" 
                    value="1"
                    <?php if ($_SESSION["category_environment"]==='1'){ echo 'checked';}?>>
                    <label for="categoryEnvironment">環境</label> <!--Environment-->
                    </td>

                    <td style="width:25%">
                    <input type="checkbox" 
                    id="categorySafetyAndHygiene" 
                    name="category_safety_and_hygiene" 
                    value="1"
                    <?php if ($_SESSION["category_safety_and_hygiene"]==='1'){ echo 'checked';}?>>
                    <label for="categorySafetyAndHygiene">安全衛生</label> <!--Safety and Hygiene-->
                    </td>

                    <td style="width:25%">
                    <div>
                    <input type="checkbox" 
                    id="categoryOther" 
                    name="category_others" 
                    value="1"
                    <?php if ($_SESSION["category_others"]==='1'){ echo "checked";}?>>
                    <label for="categoryOther">その他</label>
                    <input type="text" 
                    id="categoryOtherManual" 
                    value="<?php if ($_SESSION["category_others"]==='1'){ echo $_SESSION["category_others_manual"];}?>" 
                    name="categoryOtherManual" 
                    placeholder="PLEASE SPECIFY"
                    style="width:70%">
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
                    <td colspan="3"><input type="text" name="purposeID" id="purposeID" value="<?php echo $_SESSION["purpose"]; ?>" style="width:96%" required></td>
                    </tr>
                    <tr>
                    <td>対象者：</td>
                    <td><input type="text" name="audienceID" id="audienceID" value="<?php echo $_SESSION["audience"]; ?>" style="width:90%" required></td>
                    <td>名:</td>
                    <td style="width:50%; text-align:left;"><span id="count_value" class="count_value" style="text-align:left;"></span>
                    <input hidden type="text" value="" id="count_value_input" name="count_value_input"></td>

                    </tr>
                    </table>
            </div>
            <div id="participantsDIV" class="participantsDIV">
                    <caption><b>受講者（製造）</b></caption>        
                    <table id="participantsTable" border="1" class="table table-hover rounded-3 table-sm overflow-hidden participantsT">
                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:15%; vertical-align:middle;height:40px;">GID</th>
                                <th style="width:15%; vertical-align:middle;height:40px;">名前</th>
                                <th style="width:15%; vertical-align:middle;height:40px;">
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
                                <th style="width:15%; vertical-align:middle; height:40px;">
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
                                <th style="width:15%; vertical-align:middle; height:40px;">
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
                                <th style="width:15%; vertical-align:middle; height:40px;">
                                認定
                                </th> 
                            </tr>
                        </thead>
                        <tbody id="post_list" class="participants_tbody">
                        </tbody>
                    
                    </table>          
                </div> 
            
            <div id="contentsDIV" class="contentsDIV">
            <caption>内容</caption>
                <table id="contentsTable" border="1" class="contentsT">
                
                <tr>
                <td><textarea type="text" name="contentsID" id="contentsID" value="" class="contentsInput" rows="3" required><?php echo  $_SESSION["contents"]; ?></textarea></td>
                </tr>
                </table>
            </div>
            <div id="usageDIV">
                    <caption>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</caption>
                    <table id="usageTable" border="1" class="usageT">
                    <tr>
                    <td><textarea type="text" name="usageID" id="usageID" value="" rows="3" class="usageInput" required><?php echo  $_SESSION["usage_id"]; ?></textarea></td>
                    </tr>
                </table>
            </div>
            <div id="confirmation_by" class="confirmation_by_div">
                    <caption style="text-align:center;"><b>教育効果の確認方法、確認予定日</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" name="confirmation_by" id="confirmation_by_id" value="<?php echo  $_SESSION["confirmation_by"]; ?>" style="width:100%" required></td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width:25%; vertical-align:middle;">最終確認予定日：</td>
                            <td colspan="1" style="width:25%"><input type="datetime-local" name="confirmation_date" id="confirmation_date_id" value="<?php echo  $_SESSION["confirmation_date"]; ?>" style="width:90%" required></td>
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
                            <td colspan="3" style="width:90%"><input type="text" name="checker_people_regular" id="checker_people_regular" value="<?php echo  $_SESSION["checker_people_regular"]; ?>" style="width:100%"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" name="checker_comment_regular" id="checker_comment_regular" value="<?php echo  $_SESSION["checker_comment_regular"]; ?>" style="width:100%"></td>
                        </tr>
                    </table>
            </div>
            
          
               
            <!--------------------------------------->
            </div>

            <button type="submit" class = "btn-update" style="text-decoration:none; margin-right:20px; margin-bottom:30px;"><span>UPDATE</span></button>
            </form>
        </div>
</div>

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

    $('.common_selector').click(function(){
        filter_data();

    });

});


function count() {
var checkedboxes = $('input[name="GIDcheck[]"]:checked').length;
$('.jqValue').html(checkedboxes);
}

setTimeout(function () {
    var x = document.getElementById("participantsTable").rows.length;
document.getElementById('count_value').innerHTML = x-1;
document.getElementById('count_value_input').value = x-1;

}, 500)







</script>



</body>
</html>
