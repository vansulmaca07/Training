<?php
    
    include_once 'navigation.php'

?>
         <!-----------REGISTRATION FORM----------->
        
        <!--
        <div class="main" id="main" style="display: none">
            <div class="scroll" id="div-scroll">
            <div  id="creationdepartment">
                <h2>教育
                <input type="text"
                style="width:15%"
                name="departmentID"
                id="departmentID"
                value="">
                </h2>
            </div>
            <div id="mainrecord">
                <form action="registrationForm.php" method="post">
                    <table id="mainrecordTable" border="1" class="mainrecordT">
                    <tbody>
                    <tr>
                    <td>
                    <span>名称：</span>
                    <input type="text"
                     name="educationID"
                     id="educationID"
                     value=""
                     style="width:90%">
                    </td>
                    <td>
                    
                    <input type="radio" id="trainingLocInternal" name="trainingLoc" value="internal">
                    <label for="trainingLocInternal">社内</label>
                   
                    </td>
                    <td>
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
                    <input type="datetime-local" name="datetimeRegularStart" id="datetimeRegularStart" value="">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeRegularEnd" id="datetimeRegularEnd" value="">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationRegular" name="LocationRegular" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorRegularID" name="instructorRegularID" value="">
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
                     <caption>区分　（該当項目を丸枠で囲んで下さい。）</caption>
                    <table id="categoryTable" border="1" class="categoryT">
                    <tbody>
                    <tr>
                    <td style="width:25%">
                    <input type="checkbox" id="categoryQuality" name="categoryQuality" value="Quality">
                    <label for="categoryQuality">品質</label>
                   
                    </td>
                    <td style="width:25%">
                    <input type="checkbox" 
                    id="categoryEnvironment"
                    name="categoryEnvironment" 
                    value="Environment">
                    <label for="categoryEnvironment">環境</label>
                    </td>
                    <td style="width:25%">
                    <input type="checkbox" 
                    id="categorySafetyAndHygiene" 
                    name="categorySafetyAndHygiene" 
                    value="SafetyAndHygiene">
                    <label for="categorySafetyAndHygiene">安全衛生</label>
                    </td>
                    <td style="width:25%">
                    <div>
                    <input type="checkbox" 
                    id="categoryOther" 
                    name="categoryOther" 
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
                    <td colspan="3"><input type="text" name="purposeID" id="purposeID" value="" style="width:96%"></td>
                    </tr>
                    <tr>
                    <td>対象者：</td>
                    <td><input type="text" name="audienceID" id="audienceID" value="" style="width:90%"></td>
                    <td>名</td>
                    <td><input type="text" name="audienceNo" id="audienceNo" value="" style="width:90%"></td>
                    </tr>
                    </table>
            </div>
            <div id="contentsDIV" class="contentsDIV">
                <caption>内容</caption>
                <table id="contentsTable" border="1" class="contentsT">
                <tr>
                <td><textarea type="text" name="contentsID" id="contentsID" value="" class="contentsInput" rows="3"></textarea></td>
                </tr>
                </table>
            </div>
            <div id="usageDIV">
                    <caption>使用資料　（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</caption>
                    <table id="usageTable" border="1" class="usageT">
                    <tr>
                    <td><textarea type="text" name="usageID" id="usageID" value="" rows="3" class="usageInput"></textarea></td>
                    </tr>
                </table>
            </div>
            </form>
            
            </div>
        </div>     -->
     
       
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

<script type="text/javascript" src="home.js"></script>
