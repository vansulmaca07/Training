<?php
    include_once 'navigation.php';
    include_once 'includes/dbh2.inc.php';


    if(isset ($GET["training_id"])) {


        $training_id = $GET["training_id"];
        $query_contents = "SELECT * from training_form
        where training_id = '$training_id'";
        
        $stmt_contents = $pdo->prepare($query_contents);
        $stmt_contents->execute();
       
        $result_contents = $stmt_contents->fetchAll();
        $usage_materials = '';
        $training_name = '';
    }

 
?>

        <div class="training" id="training">
            <div id="table-wrapper3">
            <h4 style="text-align:center;">訓練</h4>
                <div id="table-scroll3">
                    <table id="trainingTable" border="1" class="table trainingT">
                        <thead>
                            <tr id="firstrow">
                                <th style="width:15%">No</th>
                                <th style="width:30%">ファイル名</th>
                                <th style="width:30%">Description</th>
                                <th style="width:25%">Completion</th>
                            </tr>
                        </thead>

                    <?php
                    $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "trainingdb";
                        
                        //Create connection

                        $connection = new mysqli($servername, $username, $password, $database);

                        //Check connection

                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        
                        //read all row from database table
                        
                        $GIDsession = $_SESSION["GID"];
                        //$sql = "SELECT * FROM users where department = '$department';";
                        $sql = "SELECT training_form.training_id, training_name, GID, contents, sign_progress 
                        FROM attendance
                        INNER JOIN training_form ON attendance.training_id = training_form.training_id
                        WHERE attendance.GIDh  = '$GIDsession';";

                        $result = $connection->query($sql);
                        
                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            <td>" . $row["training_id"] .  "</td>
                            <td>" . $row["training_name"] .  "</td>
                            <td>" . $row["contents"] .  "</td>
                            
                        ";
                        
                        if ($row["sign_progress"]==="1") {
                            
                            echo "
                                <td>
                                <form action = 'includes/complete.inc.php' method ='post' id='complete_training'>
                                <input type='text' hidden name= 'training_id' value = '$row[training_id]'>
                                <input type='text' hidden name= 'GIDfetch' value = '$GIDsession'>

                               
                                <button name='submit'>Complete</button>
                                
                          
    
                                </form>
                                
                                
                                </td>";
                            }
                            else {
                            echo "
                                <td>
                                完了
                                </td>
                            ";
                            }
                        }
                        
                        ?>   

                    
                    </table>

                    
                </div>
            </div>
        </div>
    </div> <!--mainwrapper-->
</div> <!--full-->

<script type="text/javascript">


$(document).ready(function() {


function contents_data() {
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



</script>

</body>
</html>

