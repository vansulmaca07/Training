<?php
session_start();

include ('includes/dbh2.inc.php');


 $training_id = $_SESSION["documentNo"] ;


 $query_contents = "SELECT * from training_form
 where training_id = '$training_id'";
 
 $stmt_contents = $pdo->prepare($query_contents);
 $stmt_contents->execute();

 $result_contents = $stmt_contents->fetchAll();
 $usage_materials = '';
 $training_name = '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MDB 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>  -->

    <!-- Bootstrap 5  --> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="attendance.css">

    <!-- Bootstrap 5 Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 

     <!--jQuery-->
     <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>


    <title>Document</title>
    </head>

    

<body>
    <div class="container my-5">
    <h4  class="text-center">受講者</h4>

            <div class="row row-cols-auto" style="margin-top: 30px;">
                <div class="col">
                    <!--Document No-->
                    <form action="includes/documentNo.inc.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control-plaintext docuNo" placeholder="Document No." aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="<?php echo $_SESSION["documentNo"]; ?>" name ="documentNo">
                            <button class="btn btn_search" type="submit" id="button-addon2" name="submit"><span class="bi-search"></span></button>
                        </div>
                    </form>
                </div>            
                <div class="col">  
                    <!--ID TAP-->
                    <form action="includes/attendanceTap.php" method="post" autocomplete="off" >
                        <div class="input-group mb-3">
                            <input type="text" class="form-control-plaintext docuNo" autofocus placeholder="Please TAP your ID" aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="" name ="rfid" id="attendance_input">
                            <button class="btn btn2" type="submit" id="button-addon2" name="submit"><i class="bi bi-person-vcard"></i>
                            </button>
                        </div>
                    </form>    
                </div>  
                    <!--QR_Barcode-->
                <div class="col">
                    <form action="includes/bar_qr_scan.inc.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control-plaintext docuNo" placeholder="Please scan your QR/Bar code" aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="" name ="GIDinput" autocomplete="off" id="bar_qr_input">
                            <button class="btn btn2" type="submit" id="button-addon2" name="submit"><i class="bi bi-qr-code-scan"></i></button>
                        </div>
                    </form>
                </div>
                   <!--Reference Files-->
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    教育訓練の内容と教材
                    </button>        
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                 <?php 
                                 
                                 foreach ($result_contents as $contents_training_name) {

                                        $training_name = $contents_training_name["training_name"]; 
                                 }

                                 
                                 echo $training_name; ?>
                                </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                          

                                    <?php
                                   
                                ?>

                                <table class="table-reference-files" style="width:100%; height:50px;">
                                    <thead>
                                        <th style="width:100%;">
                                        内容
                                        </th>
                                    </thead>
                                        <td style="width:100%; height:50px;">

                                    <?php
                                         foreach ($result_contents as $contents) {
                                    
                                            echo $contents["contents"];
                                            $usage_materials = $contents["usage_id"];
                                            
                                            
                                            }
                                    
                                          
                                    ?>
                                        </td>
                                                                    
                                </table>

                                <hr>
                                    
                                <table class="table-reference-files" style="width:100%; height:50px;">
                                    <thead>
                                        <th style="width:100%;">
                                        研修教材
                                        </th>
                                    </thead>
                                        <td style="width:100%; height:50px;">

                                    <?php

                                    echo $usage_materials . '<br>';
                                          
                                    ?>
                                        </td>
                                                                    
                                </table>

                                <hr>

                                <table class="table-reference-materials">
                                    <thead>
                                        <tr>
                                        <th>
                                        使用資料	
                                        </th>
                                        <th>
                                        
                                        </th>
                                        </tr>
                                    </thead>
                                        

                                        <?php
                                        $query_materials = "SELECT * FROM file_storage WHERE training_id = '$training_id'";
                                        
                                        $stmt_materials = $pdo->prepare($query_materials);
                                        $stmt_materials->execute();

                                        $result_materials = $stmt_materials->fetchAll();

                                       
                                        foreach ($result_materials as $materials) {

                                            $file_path = "includes/uploads/" . $materials['file_name'] . "." . $materials['file_ext'];
                                            echo "<tr>
                                            <td>
                                                $materials[file_name]
                                            </td>
                                            <td >
                                                <a href = $file_path class='btn btn-primary' download style ='vertical-align:middle;'><i style='vertical-align: middle;' class='bi bi-download'></i></a>
                                                
                                            </td>
                                            </tr>
                                            ";

                                        }

                                        ?>
                                        
                                        
                                </table>
                            </div>
                           
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <!--  <button type="button" class="btn btn-primary">Understood</button> -->
                        </div>
                    </div>
                </div>
            </div>



            <div id="table-wrapper">
                <div id="table-scroll"> 
                    <table id="attendanceTable" border="1" class="table table-bordered table-hover rounded-3 overflow-hidden main-T">
                        <thead class="table text-center theadstyle" style="width: 100%; margin-bottom: 0;">
                                <th style="width:20%">所属</th>
                                <th style="width:20%">GID</th>
                                <th style="width:20%">氏名</th>
                                <th style="width:20%">サイン進捗
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" class="dropdown-toggle"></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(sign_progress), status_name FROM attendance
                                                        inner join status_ref on status_id = sign_progress
                                                            ;";
                                                        $stmt = $pdo->prepare($query);
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        foreach($result as $row)
                                                            {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" class="common_selector sign_progress" value="
                                                        <?php echo $row["status_name"];
                                                        ?>
                                                        "> <?php echo $row["status_name"];
                                                            ?>
                                                    </label>
                                                </div>
                                            <?php
                                                            }
                                            ?> 
                                        </ul>   
                                    </th>
                                <th style="width:20%">完了日</th>                           
                        </thead>
                            <tbody id="post_list2">
                            </tbody>          
                    </table>

                    <?php      
                    echo
                     '<a class="btn btn2" href="includes/attendanceback.inc.php" role="button" style = "vertical-align:middle;"><i class="bi bi-arrow-return-left"></i></a>';
                     ?>
                </div>
            </div>  
    </div>
  <!--  <div class="container my-5">
       
    </div> -->
    <!-- MDB 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script> -->


    <!--Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
             
   
    <script type="text/javascript">  
    
    
let inputStart, inputStop;

$("#attendance_input")[0].onpaste = e => e.preventDefault();
// handle a key value being entered by either keyboard or scanner
var lastInput

let checkValidity = () => {
    if ($("#attendance_input").val().length < 10) {
      $("#attendance_input").val('')
  } else {
   // $("body").append($('<div style="background:green;padding: 5px 12px;margin-bottom:10px;" id="msg">ok</div>'))
  }
  timeout = false
}

let timeout = false
$("#attendance_input").keypress(function (e) {
  if (performance.now() - lastInput > 1000) {
    $("#attendance_input").val('')
  }
    lastInput = performance.now();
    if (!timeout) {
    timeout = setTimeout(checkValidity, 200)
  }
});

/****Interlock for Bar and QR Scanner 


$("#bar_qr_input")[0].onpaste = e => e.preventDefault();
// handle a key value being entered by either keyboard or scanner
var lastInput2

let checkValidity2 = () => {
    if ($("#bar_qr_input").val().length < 10) {
      $("#bar_qr_input").val('')
  } else {
   // $("body").append($('<div style="background:green;padding: 5px 12px;margin-bottom:10px;" id="msg">ok</div>'))
  }
  timeout2 = false
}

let timeout2 = false
$("#bar_qr_input").keypress(function (e) {
  if (performance.now() - lastInput2 > 1000) {
    $("#bar_qr_input").val('')
  }
    lastInput2 = performance.now();
    if (!timeout2) {
    timeout2 = setTimeout(checkValidity2, 200)
  }
});  */



//FILTERS

$(document).ready(function() {

filter_data();

function filter_data() {
    $('#post_list2').html();
    var action = 'fetch_data';
    var sign_progress = get_filter('sign_progress');
  
    $.ajax({
        url: "includes/fetch_data_attendance.inc.php",
        method: "POST",
        data: {action:action, sign_progress:sign_progress},
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

