<?php
session_start();
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

    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .theadstyle {
        background-color:rgba(4, 73, 129, 0.808);
    }
    .main-T {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .btn2 {
        background-color:rgba(4, 73, 129, 0.808);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .docuNo {
        background-color: lightgoldenrodyellow;
        font-size: 10px;
        border-radius: 0.3rem;
        padding: 5px 10px;
        color: black; 
        border: none;
        overflow: hidden;
    }   
    </style>
    <title>Document</title>
    </head>

<body>
    <div class="container my-5">
    <h2 class="text-center">受講者</h2>
                    <h3 class="text-center"><?php echo $_SESSION["documentNo"]; ?></h3>

                    <form action="includes/documentNo.inc.php" method="post">
                    <input type="text" class="docuNo" name="documentNo" id="documentnumber"
                    value="" placeholder="Please enter the document number">    
                    <button id="documentfilter" class="btn btn2" name="submit">SUBMIT</button> 
                    </form>

                    <form action="includes/attendanceTap.php" method="POST">
                    <input type="text" autofocus class="docuNo" name="rfid" id="rfid" placeholder="Please Tap your ID">
                    <button id="submit" class="btn btn2" name="submit">SUBMIT</button>
                    </form>

                    <form action="includes/BarAndQRscan.inc.php" method="post">
                    <input type="text" class="docuNo" name="GIDinput" id="GIDinput" placeholder="Please scan your QR/Bar code">
                    <button class="btn btn2" type="submit">SUBMIT</button>
                    </form>
            
                    <table id="attendanceTable" border="1" class="table table-bordered table-hover rounded-3 overflow-hidden main-T">
                    <thead class="table text-center theadstyle">
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
                            <td class ='text-center'>" . $row["date_id"] .  "</td>
                            <td class ='text-center'>" . $row["affiliation"] .  "</td>
                            <td class ='text-center'>" . $row["GID"] . "</td>
                            <td class ='text-center'>" . $row["name_"] . "</td>
                            <td class ='text-center'>" . $row["certification"] . "</td>
                            </tr>";
                        }

                        ?>          
                    </table>
                    <?php      
                    echo
                     '<a class="btn btn2" href="includes/attendanceback.inc.php" role="button">BACK</a>';
                     ?>
    </div>
    <!-- MDB 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script> -->
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 

</body>
</html>

