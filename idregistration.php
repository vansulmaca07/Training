<?php
    
   
    include_once 'navigation.php'

?>
  

<div class="idregistration" id="idregistration">
            <h4>IDカード登録</h4>
            <div id="table-wrapper5">
                <div id="table-scroll5">
                    <table id="IDregTable" border="1" class="IDregT">
                        <thead>
                    <tr id="firstrow">
                    <th style="width:25%">GID</th>
                    <th style="width:25%">名前</th>
                    <th style="width:25%">工程</th> <!--process-->
                    <th style="width:25%">ID登録状況</th> <!--ID registration status-->  
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
                        
                        
                        $department = $_SESSION["department"];
                        $sql = "SELECT * FROM users where department = '$department';";
                        
                        $result = $connection->query($sql);
                        
                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            <td>" . $row["GID"] .  "</td>
                            <td>" . $row["firstname"] .  "</td>
                            <td>" . $row["department"] .  "</td>";
                          
                        if ($row["RFID"] == '') {
                            echo "<td>
                            <form action = 'includes/idregister.php' method ='post' id='idregform'>

                            <input type='hidden' name='GIDfetch' value= ' $row[GID]'>
                            <input type='text' name='RFID' value=''>
                            
                            <button name='submit'>REGISTER</button>

                            </form>
                            
                            
                            </td>";
                        }
                        //<a href='idregister.php?GIDfetch=$row['GID']'><button>REGISTER</button></a>

                        else {
                            echo "<td>REGISTRATION COMPLETED</td>";
                        }
                       
                        }
                        
                        ?>   
                            
                    

                    
             
                    <!--<tr><td>SG026</td><td>SG026_20231221_上級監督者教育(安全衛生その他)</td><td style="bgcolor:green">完了</td><td></td><td>完了</td></tr>
                    <tr><td>SG027</td><td>SG027_20240105_通勤災害の共有、通災MAPの教育</td><td>完了</td><td></td><td>完了</td></tr>
                    <tr><td>SG028</td><td>SG028_20240110_熱戻し炉常時監視、省エネモード　取り扱い説明(安全衛生)</td><td>完了</td><td></td><td>完了</td></tr>
                    <tr><td>SG029</td><td>SG029_20240110_通勤災害についての教育(安全衛生)</td><td>完了</td><td></td><td>完了</td></tr>
                    <tr><td>SG030</td><td>SG030_20240111_AB工程　異物検出・テープ貼り位置検出カメラ教育(その他)</td><td>完了</td><td></td><td>完了</td></tr>
                    <tr><td>SG031</td><td>SG031_20240206_教育訓練記録についての教育(その他)</td><td>完了</td><td></td><td>完了</td></tr>
                    <tr><td>SG032</td><td>SG032_20240209_教育訓練記録についての教育(安全衛生)</td><td>進行中</td><td></td>
                    <td><a href="Attendance.php"><button>Attendance</button></a> </td></tr> -->
                    </table>
                 
                </div>
            </div>
        </div>
        <div class="training" id="training" style="display: none">
        <p>TRAINING</p>
        </div>
        <div class="regsignature" id="regsignature" style="display: none">
        <p>REGISTER SIGNATURE</p>
        </div>
        <div class="usermanagement" id="usermanagement" style="display: none">
        <p>USER MANAGEMENT</p>
            </div>
            </div>
    </div>
</body>
</html>

