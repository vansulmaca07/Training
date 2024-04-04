<?php
    
    include_once 'navigation.php'

?>
         <!-----------REGISTRATION FORM----------->
        
        <div class="main" id="main">
            <div class="scroll" id="div-scroll">
            <form action="includes/createform.inc.php" method="post">
            <div  id="creationdepartment">
                <h2>作成部署
                <input type="text"
                style="width:15%"
                name="departmentID"
                id="departmentID"
                value=""
                required>
                </h2>
            </div> 
            <div id="mainrecord">
                    <table id="mainrecordTable" border="1" class="mainrecordT">
                    <tbody>
                    <tr style="width:100%">
                    <td style="width:50%">
                    <span>名称：</span>
                    <input type="text"
                     name="educationID"
                     id="educationID"
                     value=""
                     style="width:90%"
                     required>
                    </td>
                    <td style="width:20%">
                    <span>工程：</span>
                    <select name="trainingDepartment" id="trainingDepartment">
                        <option value="SG">SG</option>
                        <option value="SBA">SBA</option>
                        <option value="P">P</option>
                        <option value="KT">KT</option>
                        <option value="SE">SE</option>
                        <option value="CRSE">CRSE</option>
                        <option value="ASE">ASE</option>
                        <option value="SBC">SBC</option>
                        <option value="SBA">SBA</op"tion>
                        <option value="SBN">SBN</option>
                    </select>
                    <input type="text" name="trainingIdentifier" value="" style="width:25%">    
                    </td>
                    
                    <td style="width:15%">
                    <input type="radio" id="trainingLocInternal" name="trainingLoc" value="internal" checked>
                    <label for="trainingLocInternal">社内</label>
                    <!--<select name="trainingloc" id="trainingloc">
                        <option value="internal">INTERNAL</option>
                        <option value="external">EXTERNAL</option>
                    </select>-->
                    </td>
                    <td style="width:15%">
                    <input type="radio" id="trainingLocExternal" name="trainingLoc" value="external">
                    <label for="trainingLocExternal">社外</label>
                    </td>
                    
                    </tr>
                    </tbody>
                    </table>
                    <table id="mainrecordTable2" border="1" class="mainrecordT2">
                    <tr>
                    <td>
                    <span>日勤者実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeRegularStart" id="datetimeRegularStart" value="" required>
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeRegularEnd" id="datetimeRegularEnd" value="" required>
                    </td>
                    <td>場所：
                    <input type="text" id="LocationRegular" name="LocationRegular" value="" required>
                    </td>
                    <td>講師：
                    <input type="text" id="instructorRegularID" name="instructorRegularID" value="" required>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ａ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeAStart" id="datetimeAStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeAEnd" id="datetimeAEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationA" name="LocationA" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorAID" name="instructorAID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｂ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeBStart" id="datetimeBStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeBEnd" id="datetimeBEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationB" name="LocationB" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorBID" name="instructorBID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｃ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeCStart" id="datetimeCStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeCEnd" id="datetimeCEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationC" name="LocationC" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorCID" name="instructorCID" value="">
                    </td>
                     </tr>
                    <tr>
                    <td>
                    <span>Ｄ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeDStart" id="datetimeDStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeDEnd" id="datetimeDEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationD" name="LocationD" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorDID" name="instructorDID" value="">
                    </td>
                    </tr>
                    </tbody>
                    </table>
            </div>
            <div id="categoryDIV" class="categoryDIV">
                     <caption>区分</caption>
                    <table id="categoryTable" border="1" class="categoryT">
                    <tbody>
                    <tr>
                    <td style="width:25%">
                    <input type="radio" id="categoryQuality" name="category" value="Quality" checked>
                    <label for="categoryQuality">品質</label>
                    </td>
                    <td style="width:25%">
                    <input type="radio" 
                    id="categoryEnvironment"
                    name="category" 
                    value="Environment">
                    <label for="categoryEnvironment">環境</label>
                    </td>
                    <td style="width:25%">
                    <input type="radio" 
                    id="categorySafetyAndHygiene" 
                    name="category" 
                    value="SafetyAndHygiene">
                    <label for="categorySafetyAndHygiene">安全衛生</label>
                    </td>
                    <td style="width:25%">
                    <div>
                    <input type="radio" 
                    id="categoryOther" 
                    name="category" 
                    value="Other">
                    <label for="categoryOther">その他</label>
                    <input type="text" 
                    id="categoryOtherManual" 
                    value="" 
                    name="categoryOtherManual" 
                    placeholder="PLEASE SPECIFY"
                    style="width:70%">
                    </div>
                    </td>   
                    </select>
                    </tr>
                    </tbody>
                    </table>        
            </div>
            <div id="purposeDIV" class="purposeDIV">
                     <caption>目的、対象者</caption>
                    <table id="purposeTable" border="1" class="purposeT">
                    <tr>
                    <td>目的：</td>
                    <td colspan="3"><input type="text" name="purposeID" id="purposeID" value="" style="width:96%" required></td>
                    </tr>
                    <tr>
                    <td>対象者：</td>
                    <td><input type="text" name="audienceID" id="audienceID" value="" style="width:90%" required></td>
                    <td>名</td>
                    <td><input type="text" name="audienceNo" id="audienceNo" value="" style="width:90%"></td>
                    </tr>
                    </table>
            </div>
            <div id="participantsDIV" class="participantsDIV">
                <caption>受講者（製造）</caption>
                <script>
                    function toggle(source) {
                        checkboxes = document.getElementsByName('GIDcheck[]');
                        for(var i=0, n=checkboxes.length;i<n;i++) {
                        checkboxes[i].checked = source.checked;
                        }
                    }
                </script>
                
                        <table id="participantsTable" border="1" class="participantsT">
                        <thead>
                        <tr id="firstrow">
                        <th style="width:10%"><input type="checkbox" id="select_all" onClick="toggle(this)">すべて選択</th>
                        <th style="width:22.5%">GID</th>
                        <th style="width:22.5%">名前</th>
                        <th style="width:22.5%">Team</th>
                        <th style="width:22.5%">工程</th> 
                     
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
                        
                        
                        //$department = $_SESSION["department"];
                        //$sql = "SELECT * FROM users where department = '$department';";
                        
                        $department = $_SESSION["department"];
                        $sql = "SELECT GID, name_, RFID, department_name, shift_description
                        FROM users
                        INNER JOIN department on users.department_id = department.department_id
                        INNER JOIN shift on users.shift_id = shift.shift_id
                        WHERE users.department_id ='$department';";
                        /*WHERE users.department_id ='$department';";*/

                        $result = $connection->query($sql);
                        
                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "
                            <tr>
                            <td><input type='checkbox' name='GIDcheck[]' value= '$row[GID]' ></td>
                            <td><input type='text' hidden name='GIDname[]' value= '$row[GID]'>" . $row["GID"] .  "</td>
                            <td><input type='text' hidden name='name_[]' value= '$row[name_]'> " . $row["name_"] .  "</td>
                            <td><input type='text' hidden name='shift_description[]' value= '$row[shift_description]'> " . $row["shift_description"] .  "</td>
                            <td><input type='text' hidden name='department_name[]' value= '$row[department_name]'>" . $row["department_name"] .  "</td>
                            ";
                            
                        //<a href='idregister.php?GIDfetch=$row['GID']'><button>REGISTER</button></a>
                        //<input type='hidden' name='GIDfetch' value= '$row[GID]'>
                        } 
                        ?>
                      
            </div> 
            <div id="contentsDIV" class="contentsDIV">
              
                <table id="contentsTable" border="1" class="contentsT">
                <caption>内容</caption>
                <tr>
                <td><textarea type="text" name="contentsID" id="contentsID" value="" class="contentsInput" rows="3" required></textarea></td>
                </tr>
                </table>
            </div>
            <div id="usageDIV">
                    <caption>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</caption>
                    <table id="usageTable" border="1" class="usageT">
                    <tr>
                    <td><textarea type="text" name="usageID" id="usageID" value="" rows="3" class="usageInput" required></textarea></td>
                    </tr>
                </table>
            </div>
            
            <button type="submit" class = "btn3" style="text-decoration:none;">Complete</button>
            </form>

               <!--------------------------------------->
            </div>
        </div>
</div>

</body>
</html>
