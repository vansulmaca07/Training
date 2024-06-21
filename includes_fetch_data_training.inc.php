<?php
session_start();
include('dbh2.inc.php');

$GID_session = $_SESSION["GID"];

if(isset($_POST["action"])) {

    $query = "SELECT training_form.training_id, training_name, GID, contents, sign_progress 
    FROM attendance
    INNER JOIN training_form ON attendance.training_id = training_form.training_id
    WHERE attendance.GIDh  = '$GID_session'";

    if(isset($_POST["sign_progress"]))
    {   
       $sign_progress_trimmed = array_map('trim',$_POST["sign_progress"]);
       $sign_progress_filter = implode("','",$sign_progress_trimmed);
       $query .= "AND status_ref.status_name IN('".$sign_progress_filter."')";
    }

    $query .="ORDER by training_form.training_id DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {   

            $query_files =  "SELECT * FROM file_storage
            where training_id = '$row[training_id]'";
        
            $stmt2 = $pdo->prepare($query_files);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll();
            $file_name = '';
            $file_path = '';

            $output .= 
             "<tr>
            <td style='width:10.25%;'>" . $row["training_id"] .  "</td>
            <td style='width:25.3%;'>" . $row["training_name"] .  "</td>
            <td style='width:25.5%;'>" . $row["contents"] .  "</td>
            <td style='width:20.3% ;word-break: break-all;'>";

            foreach($result2 as $row_file) {
                    $file_path = "includes/uploads/" . $row_file["file_name"] . "." . $row_file["file_ext"];
                
                    $file_name = $row_file["file_name"] . "." . $row_file["file_ext"];
    
                    $output .= "  <a href='download.php?file_id=$row_file[file_id]'>$file_name</a><br>";
                    } 
                
            if ($row["sign_progress"]==="1") {
            
            $output .= "
                </td>
                <td style='vertical-align:middle; text-align:center;'>
                <form action = 'includes/complete.inc.php' method ='post' id='complete_training'>
                <input type='text' hidden name= 'training_id' value = '$row[training_id]'>
                <input type='text' hidden name= 'GIDfetch' value = '$GID_session'>
                <button type='submit' class='btn-completion'><span>Complete</span></button>                 
                </td>
                </form>
                </tr>"
                ;

            }
            else {
            $output .= "
                </td>
                <td style='text-align:center;'>
                完了
                </td>
                </tr>
            ";
            }
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;

}
