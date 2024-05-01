<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_"];
$department = $_SESSION["department"]; 

if(isset($_POST["action"])) {
   // $query = "SELECT GID, name_, RFID, department_name, shift_description, group_, building
   // FROM users
   // INNER JOIN department on users.department_id = department.department_id
   // INNER JOIN shift on users.shift_id = shift.shift_id
   // WHERE users.group_ ='$group_'";

    $query_count_complete = "SELECT sign_progress, count(*) from attendance WHERE training_id = 'SG001' and sign_progress = '2' GROUP BY sign_progress ORDER BY COUNT(*) DESC;
    ";
    $stmt_02 = $pdo->prepare($query_count_complete);
    $stmt_02->execute();
    $result_02 = $stmt_02->fetchAll();

    $complete_count='';

    foreach($result_02 as $row_02)
    {
        $row02["count(*)"]=$complete_count;
    }

    $query_count_total = "SELECT sign_progress, count(*) from attendance WHERE training_id = 'SG001' ;";
    $stmt_03 = $pdo->prepare($query_count_total);
    $stmt_03->execute();
    $result_03 = $stmt_03->fetchAll();

    $total_count='';

    foreach($result_03 as $row_03)
    {
        $row_03["count(*)"]=$total_count;
    }

    $query = "SELECT training_id, training_name, status_name, creator, name_, category, usage_id
    from training_form 

    inner join status_ref on training_form.status_id = status_ref.status_id
    inner join users on training_form.creator = users.GID
    where training_form.creation_department ='$department'";

    if(isset($_POST["category"]))
    {   
       $category_trimmed = array_map('trim',$_POST["category"]);
       $category_filter = implode("','",$category_trimmed);
       $query .= "AND training_form.category IN('".$category_filter."')";
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
                            <td style='vertical-align: middle;'><form action = 'includes/edit_form.inc.php' method ='post' id='edit_form'>
                            <input type='text' hidden name= 'training_id' value = '$row[training_id]'><button type='submit' class='btn-link'>" . $row["training_id"] .  "</button>
                            </form></td>
                            <td style='vertical-align: middle;'>" . $row["name_"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["training_name"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["category"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["usage_id"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["status_name"] .  "</td>
                            <td style='vertical-align: middle;'>
                                <div class='progress'>
                                <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 50%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                                </div>
                                </td>
                            <td style='vertical-align: middle;'><form action='includes/documentNo.inc.php' method ='POST'>

                            <input type='text' hidden value='$row[training_id]' name='documentNo'>             
                            <button type='submit' class='btn'>サイン</button>
                            </form>
                            </td>
                </tr>";
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;
   
}
