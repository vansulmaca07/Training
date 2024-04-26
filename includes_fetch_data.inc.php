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
       //$shift_filter = implode("','",$_POST["shift"]);
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
            <td><input type='checkbox' name='GIDcheck[]' class='z' value= '$row[GID]' onchange ='count()' ></td>
            <td><input type='text' hidden name='GIDname[]' value= '$row[GID]'>" . $row["GID"] .  "</td>
            <td><input type='text' hidden name='name_[]' value= '$row[name_]'> " . $row["name_"] .  "</td>
            <td><input type='text' hidden name='shift_description[]' value= '$row[shift_description]'> " . $row["shift_description"] .  "</td>
            <td><input type='text' hidden name='department_name[]' value= '$row[department_name]'>" . $row["department_name"] .  "</td>
            <td><input type='text' hidden name='building[]' value= '$row[building]'>" . $row["building"] .  "</td>
            </tr>";
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;
   
}
