<?php
session_start();
include('dbh2.inc.php');

 $documentNo = $_SESSION["documentNo"];

if(isset($_POST["action"])) {

    $query = "SELECT date_id, affiliation, GIDh, name_, status_name FROM attendance
    INNER JOIN status_ref on attendance.sign_progress = status_ref.status_id
    WHERE training_id = '$documentNo'";

    if(isset($_POST["sign_progress"]))
    {   
       $sign_progress_trimmed = array_map('trim',$_POST["sign_progress"]);
       $sign_progress_filter = implode("','",$sign_progress_trimmed);
       $query .= "AND status_ref.status_name IN('".$sign_progress_filter."')";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {   
            $output .= 
                "<tr>                
                    <td class ='text-center' style= 'width:20%;'>" . $row["affiliation"] .  "</td>
                    <td class ='text-center' style= 'width:20%;'>" . $row["GIDh"] . "</td>
                    <td class ='text-center' style= 'width:20%;'>" . $row["name_"] . "</td>
                    <td class ='text-center' style= 'width:20%;'>" . $row["status_name"] . "</td>
                    <td class ='text-center' style= 'width:18.5%;'>" . $row["date_id"] .  "</td>
                </tr>";
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;

}
