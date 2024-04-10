<?php  
    include_once 'navigation.php'
?>

<div class="progress" id="progress">
            <h4>進捗状況</h4>
            <div id="table-wrapper">
                <div id="table-scroll">
                    <table id="progressTable" border="1" class="progressT">
                        <thead>
                    <tr id="firstrow">
                    <th style="width:10%">No</th>
                    <th style="width:10%">作成者</th> <!--creator-->
                    <th style="width:20%">ファイル名</th>
                    <th style="width:10%">区分</th>
                    <th style="width:20%">教材</th>
                    <th style="width:10%">全体状態</th>
                    <th style="width:10%">備考欄</th>
                    <th style="width:10%">【サイン進捗】</th>
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
                        $department = $_SESSION["department"];
                        $group_ = $_SESSION["group_"];
                        $sql = "SELECT document_id, training_name, status_name, creator, name_, category, usage_id
                        from training_form 

                        inner join status_ref on training_form.status_id = status_ref.status_id
                        inner join users on training_form.creator = users.GID

                        where training_form.creation_department ='$department';"; 

                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            <td>" . $row["document_id"] .  "</td>
                            <td>" . $row["creator"] .  "</td>
                            <td>" . $row["training_name"] .  "</td>
                            <td>" . $row["category"] .  "</td>
                            <td>" . $row["usage_id"] .  "</td>
                            <td>" . $row["status_name"] .  "</td>
                            <td></td>
                            <td><form action='includes/documentNo.inc.php' method ='POST'>
                            <input type='text' hidden value='$row[document_id]' name='documentNo'>             
                            <button type='submit'>サイン</button>
                            </form>
                            </td>
                            
                            </tr>";
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

