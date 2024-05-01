<?php
session_start();

include ('includes/dbh2.inc.php');
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <h3 class="text-center">受講者</h3>

            <!--Document No-->
            <form action="includes/documentNo.inc.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control-plaintext docuNo" placeholder="Document No." aria-label="Recipient's username" aria-describedby="button-addon2"
                    value="<?php echo $_SESSION["documentNo"]; ?>" name ="documentNo">
                    <button class="btn btn2" type="submit" id="button-addon2" name="submit"><span class="bi-search"></span></button>
                </div>
            </form>            
            
            <!--ID TAP-->
            <form action="includes/attendanceTap.php" method="post" autocomplete="off" >
                <div class="input-group mb-3">
                    <input type="text" class="form-control-plaintext docuNo" autofocus placeholder="Please TAP your ID" aria-label="Recipient's username" aria-describedby="button-addon2"
                    value="" name ="rfid" id="attendance_input">
                    <button class="btn btn2" type="submit" id="button-addon2" name="submit"><i class="bi bi-person-vcard"></i>
                    </button>
                </div>
            </form>

            <!--QR_Barcode-->
        
            <form action="includes/bar_qr_scan.inc.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control-plaintext docuNo" placeholder="Please scan your QR/Bar code" aria-label="Recipient's username" aria-describedby="button-addon2"
                    value="" name ="GIDinput" autocomplete="off">
                    <button class="btn btn2" type="submit" id="button-addon2" name="submit"><i class="bi bi-qr-code-scan"></i> / <i class="bi bi-upc-scan"></i></button>
                </div>
            </form>
            <div id="table-wrapper">
                <div id="table-scroll"> 
                    <table id="attendanceTable" border="1" class="table table-bordered table-hover rounded-3 overflow-hidden main-T">
                        <thead class="table text-center theadstyle">
                            <tr id="firstrow">
                                <th style="width:20%">所属</th>
                                <th style="width:20%">GID</th>
                                <th style="width:20%">氏名</th>
                                <th style="width:20%">サイン進捗</th>
                                <th style="width:20%">完了日</th>
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

                        $documentNo = $_SESSION["documentNo"];
                        $sql = "SELECT date_id, affiliation, GIDh, name_, status_name FROM attendance
                            INNER JOIN status_ref on attendance.sign_progress = status_ref.status_id
                            WHERE training_id = '$documentNo'";
                                    
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }
                        //read data of each row



                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            
                            <td class ='text-center'>" . $row["affiliation"] .  "</td>
                            <td class ='text-center'>" . $row["GIDh"] . "</td>
                            <td class ='text-center'>" . $row["name_"] . "</td>
                            <td class ='text-center'>" . $row["status_name"] . "</td>
                            <td class ='text-center'>" . $row["date_id"] .  "</td>
                            </tr>";
                        }

                        ?>          
                    </table>
                    </div>
                    </div>
    </div>
    <div class="container my-5">
        <?php      
                    echo
                     '<a class="btn btn2" href="includes/attendanceback.inc.php" role="button">BACK</a>';
                     ?>
        
    </div>
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
</script>
</body>
</html>

