<?php
    
    include_once 'navigation.php'

?>


<div class="namelist" id="namelist">
            <h4>名簿マスタ</h4>
            <div id="table-wrapper4">
                <div id="table-scroll4">
                    <table id="namelistTable" border="1" class="namelistT">
                        <thead>
                    <tr id="firstrow">
                    <th style="width:15%">No.</th>
                    <th style="width:40%">GID</th>
                    <th style="width:15%">名</th>
                    <th style="width:15%">姓</th>
                    <th style="width:15%">shift</th>
                    
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

                        //$sql = "SELECT * FROM '{$_SESSION["documentNo"]}'";
                        $sql = "SELECT * FROM users
                        where department = '001' ";
                        
                        
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            <td>" . $row["id"] .  "</td>
                            <td>" . $row["GID"] .  "</td>
                            <td>" . $row["firstname"] .  "</td>
                            <td>" . $row["surname"] .  "</td>
                            <td>" . $row["shift"] .  "</td>
                            <td>  </td>
                            <td></td>
                            
                            </tr>";
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

