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

    $query = "SELECT document_id, training_name, status_name, creator, name_, category, usage_id
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
                            <input type='text' hidden name= 'training_id' value = '$row[document_id]'><button type='submit' class='btn-link'>" . $row["document_id"] .  "</button>
                            </form></td>
                            <td style='vertical-align: middle;'>" . $row["name_"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["training_name"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["category"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["usage_id"] .  "</td>
                            <td style='vertical-align: middle;'>" . $row["status_name"] .  "</td>
                            <td style='vertical-align: middle;'><form action='includes/documentNo.inc.php' method ='POST'>
                            <input type='text' hidden value='$row[document_id]' name='documentNo'>             
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
