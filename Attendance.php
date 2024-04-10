<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="attendance.css"> 

 <!--   <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    /> -->
  
    <!-- MDB 
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
    rel="stylesheet"
    />  -->
   
    <title>Document</title>

</head>
<body>
    <h1>受講者（製造）</h1>
    <div class="try">
        <div class="attendanceinput">

            <form action="includes/documentNo.inc.php" method="post">
            <input type="text" class="documentfilter" name="documentNo" id="documentnumber"
            value="" placeholder="Please enter the document number">    
            <button id="documentfilter" class="submit" name="submit">SUBMIT</button> 
         <!--   <button class="btn btn-primary" name ="submit" data-mdb-ripple-init> 
            <i class="fas fa-search"></i>
            </button> -->
            </form>

            <form action="includes/attendanceTap.php" method="POST">
            <input type="text" autofocus class="attendanceTap" name="rfid" id="rfid" placeholder="Please Tap your ID">
            <button id="submit" class="submit" name="submit">SUBMIT</button>
            </button>
            </form>

            <form action="includes/BarAndQRscan.inc.php" method="post">
            <input type="text" class="documentfilter" name="GIDinput" id="GIDinput" placeholder="Please scan your QR/Bar code">
            <button name="submit" class="submit" type="submit">SUBMIT</button>
            <button type="button" class="btn btn-primary" data-mdb-ripple-init> 
            <i class="fas fa-search"></i>
            </button>
            </form>
            </div>

            <div class="companyfilter"> <!--***RESERVED***-->

                <!--<select name="plantsite" id="plantsite" class="plantsitefilter">
                <option value="JTY">JTY</option>
                <option value="CGTY">CGTY</option>
                <option value="KKTY">KKTY</option>
                    <option value="MSTY">MSTY</option> 
                </select>-->    
        
             </div>    

            <div id="attendanceDIV">
                <div id="table-scroll2">
                    <table id="attendanceTable" border="1" class="attendanceT">
                    <caption><?php echo $_SESSION["documentNo"]; ?></caption>
                    <thead>
                    <tr id="firstrow">
                    <th style="width:20%">日付</th>
                    <th style="width:20%">所属</th>
                    <th style="width:20%">GID</th>
                    <th style="width:20%">氏名</th>
                    <th style="width:20%">認定</th></tr>
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
                        $sql = "SELECT * FROM attendance where training_id = '$documentNo'";
                                    
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            <td>" . $row["date_id"] .  "</td>
                            <td>" . $row["affiliation"] .  "</td>
                            <td>" . $row["GID"] . "</td>
                            <td>" . $row["name_"] . "</td>
                            <td>" . $row["certification"] . "</td>
                            </tr>";
                        }

                        ?>          
                    </table>
                </div>
                <?php      
                    echo
                     '<a href="includes/attendanceback.inc.php" class = "btn3" style="text-decoration:none;">BACK</a>';
                     ?>
            </div>
    </div>
    <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"
  ></script>
       
</body>
</html>

