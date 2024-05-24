<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_"];
$department = $_SESSION["department"]; 

if(isset($_POST["action"])) {

    $query = "SELECT training_id, training_name, status_name, creator, name_, category, usage_id, date_created
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

    $query .= "ORDER BY training_form.date_created ASC";

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


            $query_category = "SELECT category.category_id, category_name FROM category

            inner join category_ref on category_ref.category_id = category.category_id

            where training_id = '$row[training_id]'";

            $stmt3 = $pdo->prepare($query_category);
            $stmt3->execute();
            $result3 = $stmt3->fetchAll();

          

            $output .= 
                "<tr>
                            <td style='vertical-align: middle; width: 10.1%;'><form action = 'includes/edit_form.inc.php' method ='post' id='edit_form'>
                            <input type='text' hidden name= 'training_id' value = '$row[training_id]'><button type='submit' class='btn-link'>" . $row["training_id"] .  "</button>
                            </form>
                            </td>

                            <td style='vertical-align: middle; font-size:20px; width:10.2%;'><a href = 'pdf_preview.php?training_id=$row[training_id]' target='_blank'><i class='bi bi-file-pdf'></i></a></button>
                            </td>

                            <td style='vertical-align: middle; width: 10.2%;'>" . $row["name_"] .  "</td>
                            <td style='vertical-align: middle; width: 20.3%;'>" . $row["training_name"] .  "</td>
                            <td style='vertical-align: middle; width: 10.2%;'>  
                           ";

                            foreach($result3 as $row_file) {
                                
                                    $output .= "$row_file[category_name],";
                                    }

             /*   foreach($result3 as $row_file) {
                    $file_path = "includes/uploads/" . $row_file["file_name"] . "." . $row_file["file_ext"];
                
                    $file_name = $row_file["file_name"] . "." . $row_file["file_ext"];
    
                    $output .= " <td> <a href = $file_path download>$file_name</a><br></td>";
                    } */
    

           
            
            $output .= "    </td> 
                            <td style='vertical-align: middle; width: 10.2%;'>" . $row["usage_id"] .  "</td>
                            <td style='vertical-align: middle; width:15.1% ;'>" . $row["status_name"] .  "</td>
                            <td style='vertical-align: middle; width: ;'>
                            <form action='includes/documentNo.inc.php' method ='POST'>
                            <input type='text' hidden value='$row[training_id]' name='documentNo'>             
                            <button type='submit' class='btn-attendance'><span>サイン</span></button>
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

?>
