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
                    <th style="width:17.5%">GID</th>
                    <th style="width:17.5%">名前</th>
                    <th style="width:17.5%">姓</th>
                    <th style="width:17.5%">工程</th> <!--process-->
                    <th style="width:30%">ID登録状況</th> <!--ID registration status-->  
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
                            <td>" . $row["GID"] .  "</td>
                            <td>" . $row["name_"] .  "</td>
                            <td>" . $row["shift_description"] .  "</td>
                            <td>" . $row["department_name"] .  "</td>";
                          
                        if ($row["RFID"] == '') {
                            echo "<td>
                            <form action = 'includes/idregister.php' method ='post' id='idregform'>
                            <input type='text' hidden name= 'GIDfetch' value = '$row[GID]'>
                            <input type='text' name='rfid' value=''>
                            <button name='submit'>REGISTER</button>
                            </form>
                            </td>";
                        }
                        //<a href='idregister.php?GIDfetch=$row['GID']'><button>REGISTER</button></a>
                        //<input type='hidden' name='GIDfetch' value= '$row[GID]'>
                        else {
                            echo "<td>REGISTRATION COMPLETED</td>";
                        }
            
                        }
                        
                        ?>   
                            
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

