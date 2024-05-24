<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_"]; 

if(isset($_POST["action"])) {
    $query = "SELECT GID, name_, RFID, department_name, shift_description, group_, building
    FROM users
    INNER JOIN department on users.department_id = department.department_id
    INNER JOIN shift on users.shift_id = shift.shift_id
    WHERE users.group_ ='$group_'";

    if(isset($_POST["shift"]))
    {   
       $shift_trimmed = array_map('trim',$_POST["shift"]);
       $shift_filter = implode("','",$shift_trimmed);
       $query .= "AND shift.shift_description IN('".$shift_filter."')";
    }

    if(isset($_POST["process"]))
    {
       $process_trimmed = array_map('trim',$_POST["process"]);
       $process_filter = implode("','",$process_trimmed); 
       $query .= "AND department.department_name IN('".$process_filter."')";
    }

    if(isset($_POST["building"]))
    {
       $building_trimmed = array_map('trim',($_POST["building"]));
       $building_filter = implode("','",$building_trimmed); 
       $query .= "AND users.building IN('".$building_filter."')";
    }

    $query .= "ORDER BY shift.shift_description ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {
            $output .= "
            <tr>
            <td style='vertical-align: middle;'>" . $row["GID"] .  "</td>
            <td style='vertical-align: middle;'>" . $row["name_"] .  "</td>
            <td style='vertical-align: middle;'>" . $row["shift_description"] .  "</td>
            <td style='vertical-align: middle;'>" . $row["department_name"] .  "</td>
            <td style='vertical-align: middle;'>" . $row["building"] .  "</td>";
    
            if ($row["RFID"] == '') {

            $output .= 
            "<td style='vertical-align: middle;'>
                <form action = 'includes/idregister.php' method ='post' id='idregform'>
                    <div class='form-inline'>
                        <input type='text' hidden name= 'GIDfetch' value = '$row[GID]'>
                        <input type='text' class='register_input' placeholder='Please TAP your ID' value='' name ='rfid'>
                        <button class='btn-36' name='submit' type='submit' style='vertical-align: middle;'>登録</button>
                    </div>
                </form>
                </td></tr>";
            }

            else {
            
            $output .=    "<td style='vertical-align: middle'>登録完了</td></tr>";
                }
            
            
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;
   
}
