<?php  
    include_once 'navigation.php';
    include("includes/dbh2.inc.php");
?>

        <div class="progress" id="progress">
            <h4>進捗状況</h4>
                <div id="table-wrapper">
                    <div id="table-scroll"> 
                        <table id="progressTable" border="1" class="table table-hover rounded-3 overflow-hidden progressT">
                            <thead>
                                <tr id="firstrow">
                                    <th style="width:10%; vertical-align:middle;">No</th>
                                    <th style="width:15%; vertical-align:middle;">作成者</th> <!--creator-->
                                    <th style="width:10%; vertical-align:middle;">ファイル名</th>
                                    <th style="width:10%; vertical-align:middle;">
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle">区分</a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <?php
                                                    $query = "SELECT DISTINCT(category) FROM training_form
                                                        ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                        {
                                                ?>
                                                    <div class="list-group-item checkbox">
                                                        <label><input type="checkbox" class="common_selector category" value="
                                                            <?php echo $row["category"];
                                                            ?>
                                                            "> <?php echo $row["category"];
                                                                ?>
                                                        </label>
                                                    </div>
                                                        <?php
                                                        }
                                                        ?> 
                                            </ul>   
                                    </th>
                                    <th style="width:10%; vertical-align:middle;">使用資料</th> <!--Training References-->
                                    <th style="width:15%; vertical-align:middle;">研修教材 </th><!--Training Materials---> 
                                    <th style="width:15%; vertical-align:middle;">全体状態</th> <!--Category-->
                                   <!-- <th style="width:10%; vertical-align:middle;">進捗</th> -->
                                    <th style="width:15%; vertical-align:middle;">【サイン進捗 </th>
                                </tr>
                            </thead>
                            <tbody id="post_list2">
                            </tbody>
                        </table>        
                    </div>
                </div>
        </div>
    </div> <!--mainwrapper-->
</div> <!--full-->

<script type="text/javascript">

$(document).ready(function() {

  filter_data();

  function filter_data() {
      $('#post_list2').html();
      var action = 'fetch_data';
      var category = get_filter('category');
    
      $.ajax({
          url: "includes/fetch_data_progress.inc.php",
          method: "POST",
          data: {action:action, category:category},
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
});

</script>
</body>
</html>

