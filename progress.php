<?php  
   include_once 'navigation.php';

    //include_once 'navigation_test.php';
    include("includes/dbh2.inc.php");
?>
 
            <div class="progress" id="progress">
                <div class="main-header" style="position: relative; width:100%;">
                    <div class="header-1" style="text-align:center;">
                        <h4><b>進捗状況</b></h4>
                    </div>
                    <div class="header-2" style=" float:left; margin-left:5%;">
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">工程&nbsp;&nbsp;<i class="bi bi-funnel"></i></button>
                    </div>
                </div>

                <!--MODAL-->

                 <!-- Modal -->
                 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Filters</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">                                   
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="width:30%;">工程</span>
                                        <select class="selectpicker form-control" multiple id="inputGroupSelect01" data-actions-box="true" aria-label="size 3 select example">
                                            <?php
                                            $query_department = "SELECT * FROM department";

                                            $stmt = $pdo->prepare($query_department);
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();
                                            foreach($result as $department_list) {
                                                echo "<option value='$department_list[department_id]' name='department_main_filter[]' id='department_main_filter' class='department_main_filter'>$department_list[department_name] </option>";                       
                                               
                                            }
                                            ?>
                                         </select>
                                    </div>
                                    
                                   <!-- <div class="input-group mb-3">
                                        <span class="input-group-text"  style="width:30%; margin-bottom: 0;">No.</span>
                                        <input type="text"  class="form-control  training_id_main_filter" name="training_id_main_filter" id="training_id_main_filter" value="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="width:30%;">タイトル名</span>
                                        <input type="text" class="form-control training_name_main_filter" name="training_name_main_filter" id="training_name_main_filter" value="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="width:30%;">作成者</span>
                                        <input type="text"  class="form-control training_creator_main_filter" name="training_name_main_filter" id="training_name_main_filter" value="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="width:30%;">区分</span>
                                        <select class="selectpicker form-control" multiple id="inputGroupSelect01" aria-label="size 3 select example" data-actions-box="true">
                                        <?php
                                            $query_category_main = "SELECT * FROM category_ref";

                                            $stmt_cat_main = $pdo->prepare($query_category_main);
                                            $stmt_cat_main->execute();
                                            $result_cat_main = $stmt_cat_main->fetchAll();
                                            foreach($result_cat_main as $category_list) {
                                                echo "<option value='$category_list[category_id]' name='category_main_filter[]' id='category_main_filter' class='category_main_filter'>$category_list[category_name]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>-->
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary main-filter" data-bs-dismiss="modal">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Process Filter-->                
                    <div id="table-wrapper">
                        <div id="table-scroll"> 
                        <table id="progressTable" class="table table-bordered table-hover rounded-3 overflow-auto progressT" >
                        <thead class="theadstyle">
                            <tr id="firstrow" style="width:100%">
                                    <th style="width:10%; vertical-align:middle;">No
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle"></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="list-group-item">
                                                    <div class="form-group">
                                                        <input type="text" name="training_id_search" id="training_id_search" class="form-control" placeholder="Search Training ID">
                                                    </div>
                                                </div>              
                                            </ul> 
                                    </th>
                                    <th style="width:10%; vertical-align:middle;">PDF Preview</th>
                                    <th style="width:10%; vertical-align:middle;">作成者
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle"></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="list-group-item">
                                                    <div class="form-group">
                                                        <input type="text" name="training_creator" id="training_creator" class="form-control" placeholder="Search Training Creator">
                                                    </div>
                                                </div>              
                                            </ul> 
                                    </th> <!--creator-->
                                    <th style="width:20%; vertical-align:middle;">ファイル名
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle"></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="list-group-item">
                                                    <div class="form-group">
                                                        <input type="text" name="training_name" id="training_name" class="form-control" placeholder="Search Training Name">
                                                    </div>
                                                </div>              
                                            </ul> 
                                    </th>
                                    <th style="width:10%; vertical-align:middle;">
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">区分</a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <?php
                                                    $query = "SELECT distinct C.category_id, CR.category_name   FROM category C
                                                    INNER JOIN (select distinct category_id, category_name from category_ref) CR  
                                                    ON C.category_id = CR.category_id
                                                    ORDER by C.category_id ASC;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                        {
                                                ?>
                                                    <div class="list-group-item checkbox">
                                                        <label><input type="checkbox" class="common_selector category" value="
                                                            <?php echo $row["category_id"];
                                                            ?>
                                                            "> <?php echo $row["category_name"];
                                                                ?>
                                                        </label>
                                                    </div>
                                                        <?php
                                                        }
                                                        ?> 
                                            </ul>                                         
                                    </th>
                                    <th style="width:10%; vertical-align:middle;">使用資料</th> <!--Training References-->
                                    <th style="width:15%; vertical-align:middle;">
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">全体状態</a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <?php
                                                    $query_status = "SELECT distinct T.status_id, SR.status_name FROM training_form T
                                                    INNER JOIN (select distinct status_id, status_name from status_ref) SR  
                                                            ON T.status_id = SR.status_id
                                                    WHERE creation_department = '$_SESSION[department]'        
                                                    ORDER by T.status_id ASC";
                                                    $stmt_status = $pdo->prepare($query_status);
                                                    $stmt_status->execute();
                                                    $result_status = $stmt_status->fetchAll();
                                                    foreach($result_status as $row_status)
                                                        {
                                                ?>
                                                    <div class="list-group-item checkbox">
                                                        <label><input type="checkbox" class="common_selector status" value="
                                                            <?php echo $row_status["status_id"];
                                                            ?>
                                                            "> <?php echo $row_status["status_name"];
                                                                ?>
                                                        </label>
                                                    </div>
                                                        <?php
                                                        }
                                                        ?> 
                                            </ul> 
                                    
                                    </th> <!--Category-->
                                    <!-- <th style="width:10%; vertical-align:middle;">進捗</th> -->
                                    <th style="width:15%; vertical-align:middle; text-align:center;">【サイン進捗 </th>
                            </tr>
                        </thead>
                        <tbody id="post_list2">
                        </tbody>
                    </table>    
                        </div>
                    </div>
            </div>    
        
    </div> <!--mainwrapper-->
</div><!-- full to include-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

filter_data();

function filter_data() {
    $('#post_list2').html();
    var action = 'fetch_data';
    var category = get_filter('category');
    var status =get_filter('status');
    var department_main_filter = get_filter('department_main_filter');
    var category_main_filter =get_filter('category_main_filter');
    var training_name = $('#training_name').val();
    var training_creator = $('#training_creator').val();
    var training_id_search = $('#training_id_search').val();
    var training_name_main_filter = $('#training_name_main_filter').val();
    var training_id_main_filter = $('#training_id_main_filter').val();
    var training_creator_main_filter = $('#training_creator_main_filter').val();
  
    $.ajax({
        url: "includes/fetch_data_progress.inc.php",
        method: "POST",
        data: {action:action, 
          category:category, 
          status:status, 
          department_main_filter:department_main_filter,
          category_main_filter:category_main_filter, 
          training_name:training_name, 
          training_creator:training_creator,
          training_id_search:training_id_search,
          training_creator_main_filter:training_creator_main_filter,
          training_id_main_filter:training_id_main_filter,
          training_name_main_filter:training_name_main_filter},

        success:function(data){
          $('#post_list2').html(data);
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

$('.main-filter').click(function(){
    filter_data();
});

// search for training name

$('#training_name').keyup(function(event){
  event.preventDefault();

  filter_data();

});

$('#training_creator').keyup(function(event){
  event.preventDefault();
  filter_data();

});

$('#training_id_search').keyup(function(event){
  event.preventDefault();
  filter_data();

});


});


//

function get_main_filter(class_name)
{
  var main_filter = [];
  $('.'+class_name+':checked').each(function(){
      main_filter.push($(this).val());
  });

  console.log(main_filter);
  return main_filter;

}


</script>

</script>
</body>
</html>

