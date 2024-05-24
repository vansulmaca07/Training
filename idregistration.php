<?php
    include_once 'navigation.php';
    
    $group_ = $_SESSION["group_"];
?>
        
        <div class="idregistration" id="idregistration">
        <h4>IDカード登録</h4>
            <div id="table-wrapper5">
                <div id="table-scroll5">
                    <table id="IDregTable" border="1" class="table table-hover rounded-3 overflow-hidden IDregT">
                        <thead>
                            <tr id="firstrow">
                                <th style="width:15%; vertical-align:middle;">GID</th>
                                <th style="width:15%; vertical-align:middle;">名前</th>
                                <th style="width:15%; vertical-align:middle;height:40px; vertical-align:middle;">
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
                                </th> <!--process-->
                                <th style="width:10%; vertical-align:middle;">
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
                                <th style="width:30%; vertical-align:middle;"><b>ID登録状況</b></th> <!--ID registration status-->
                            </tr>  
                        </thead>
                        <tbody id="post_list">

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
  //$('#post_list').html();
  var action = 'fetch_data';
  var shift = get_filter('shift');
  var process = get_filter('process');
  var building = get_filter('building');

  $.ajax({
      url: "includes/fetch_data_id_register.inc.php",
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
</script>
</body>

</html>

