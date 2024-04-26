<?php
    include_once 'navigation.php'
?>
        
        <div class="idregistration" id="idregistration">
        <h4>IDカード登録</h4>
            <div id="table-wrapper5">
                <div id="table-scroll5">
                    <table id="IDregTable" border="1" class="table table-hover rounded-3 overflow-hidden IDregT">
                        <thead>
                            <tr id="firstrow">
                                <th style="width:17.5%">GID</th>
                                <th style="width:17.5%">名前</th>
                                <th style="width:17.5%">姓</th>
                                <th style="width:17.5%">工程</th> <!--process-->
                                <th style="width:30%"><b>ID登録状況</b></th> <!--ID registration status-->
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
                                 
                                $department = $_SESSION["department"];
                                $sql = "SELECT GID, name_, RFID, department_name, shift_description
                                FROM users
                                INNER JOIN department on users.department_id = department.department_id
                                INNER JOIN shift on users.shift_id = shift.shift_id
                                WHERE users.department_id ='$department';";

                                $result = $connection->query($sql);
                                
                                if (!$result) {
                                    die("Invalid Query: " . $connection->error);
                                }

                                //read data of each row
                                while ($row = $result->fetch_assoc()){

                                echo "<tr>
                                        <td style='vertical-align: middle;'>" . $row["GID"] .  "</td>
                                        <td style='vertical-align: middle;'>" . $row["name_"] .  "</td>
                                        <td style='vertical-align: middle;'>" . $row["shift_description"] .  "</td>
                                        <td style='vertical-align: middle;'>" . $row["department_name"] .  "</td>";
                                
                                if ($row["RFID"] == '') {
                                    echo "<td style='vertical-align: middle;'>
                                            <form action = 'includes/idregister.php' method ='post' id='idregform'>
                                                <div class='form-inline'>
                                                    <input type='text' hidden name= 'GIDfetch' value = '$row[GID]'>
                                                    <input type='text' class='register_input' placeholder='Please TAP your ID' value='' name ='rfid'>
                                                    <button class='btn-36' name='submit' type='submit' style='vertical-align: middle;'>登録</button>
                                                </div>
                                            </form>
                                            </td>";
                                }
                                else {
                                    echo "<td style='vertical-align: middle'>登録完了</td>";
                                }
                    
                                }
                                ?>           
                    </table>                        
                </div>
            </div>
        </div>
    </div> <!--mainwrapper-->
</div> <!--full-->
</body>

</html>

