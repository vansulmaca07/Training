<?php
    include_once 'navigation.php'
?>


<div class="training" id="training">
            
            <div id="table-wrapper3">
            <h4>訓練</h4>
                <div id="table-scroll3">
                    <table id="trainingTable" border="1" class="trainingT">
                    <thead>
                    <tr id="firstrow">
                    <th style="width:15%">No</th>
                    <th style="width:30%">ファイル名</th>
                    <th style="width:30%">Description</th>
                    <th style="width:25%">Completion</th>

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
                        $sql = "SELECT training_id, training_name, GID, contents 
                        FROM attendance
                        INNER JOIN training_form ON attendance.training_id = training_form.document_id
                        WHERE GIDh = '$GIDsession';";

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
                        
                        if ($row["GID"]!==$GIDsession) {

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
        </div>
    </div>
</body>
</html>

<!--<tr><td>Training 004</td><td>SG031_20240206_教育訓練記録についての教育(その他)</td><td>Description Sample</td><td>完了</td></tr>
                    <form action="includes/complete.inc.php" method="post">
                    <tr><td>Training 005</td><td>SG032_20240209_教育訓練記録についての教育(安全衛生)</td><td>Description 2</td><td><button>Complete</button></td></tr></form>-->
