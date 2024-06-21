<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_"];
$department = $_SESSION["department"]; 

if(isset($_POST["action"])) {

    $query = "SELECT DISTINCT training_form.training_id, training_name, status_name, creator, name_, category, usage_id, date_created, training_form.status_id
    from training_form 
    inner join status_ref on training_form.status_id = status_ref.status_id
    inner join users on training_form.creator = users.GID
	inner join category on training_form.training_id = category.training_id
    where condition_ ='1'";

    if(isset($_POST["department_main_filter"]))
    {   
        
        $department_main_filter_trimmed = array_map('trim',$_POST["department_main_filter"]);
        $department_main_filter = implode("','",$department_main_filter_trimmed);
        $query .= "AND training_form.creation_department IN('".$department_main_filter."')";

        $_SESSION["department_main_filter"] =   $department_main_filter_trimmed; //set session filter for main department

    }
   
    else {
        $query .= "AND training_form.creation_department IN ('".$department."')";
    } 

    if(isset($_POST["category_main_filter"]))
    {   
        $category_main_filter_trimmed = array_map('trim',$_POST["category_main_filter"]);
        $category_main_filter = implode("','",$category_main_filter_trimmed);
        $query .= "AND category.category_id IN('".$category_main_filter."')";

        $_SESSION["category_main_filter"] = $category_main_filter_trimmed; //set session filter for main department
    }

    if(isset($_POST["training_name_main_filter"]))
    {
        $training_name_main_filter = $_POST['training_name_main_filter'];
        $query .= "AND training_name LIKE ('%$training_name_main_filter%')";

        $_SESSION["training_name_main_filter"] = $training_name_main_filter;
    }

    if(isset($_POST["training_id_main_filter"]))
    {
        $training_id_main_filter = $_POST['training_id_main_filter'];
        $query .= "AND training_form.training_id LIKE ('%$training_id_main_filter%')
        ";

        $_SESSION["training_id_main_filter"] = $training_id_main_filter;
    }

    if(isset($_POST["training_creator_main_filter"]))
    {
        $training_creator_main_filter = $_POST['training_creator_main_filter'];
        $query .= "AND name_ LIKE ('%$training_creator_main_filter%')
        ";

        $_SESSION["training_creator_main_filter"] = $training_creator_main_filter;
    }
 
    //Search Query

    if(isset($_POST["training_name"]))
    {   
        $training_name = $_POST['training_name'];
        $query .= "AND training_name LIKE ('%$training_name%')
        ";

        $_SESSION["training_name_filter"] = $training_name;
    }

    if(isset($_POST["training_creator"]))
    {   
        $training_creator = $_POST['training_creator'];
        $query .= "AND name_ LIKE ('%$training_creator%')
        ";

        $_SESSION["training_creator_filter"] = $training_creator;

      
    }

    if(isset($_POST["training_id_search"]))
    {   
        $training_id_search = $_POST['training_id_search'];
        $query .= "AND training_form.training_id LIKE ('%$training_id_search%')
        ";

        $_SESSION["training_id_filter"] = $training_id_search;
    }

    if(isset($_POST["category"]))
    {   
       $category_trimmed = array_map('trim',$_POST["category"]);
       $category_filter = implode("','",$category_trimmed);
       $query .= "AND category.category_id IN('".$category_filter."')";

       $_SESSION["category_filter"] = $category_trimmed;
    }

    if(isset($_POST["status"]))
    {   
       $status_trimmed = array_map('trim',$_POST["status"]);
       $status_filter = implode("','",$status_trimmed);
       $query .= "AND training_form.status_id IN('".$status_filter."')";

       $_SESSION["status_filter"] = $status_trimmed;
    }

    $query .= "ORDER BY training_form.date_created DESC";

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
                "<tr style='max-height: 70px; overflow: auto;' >
                            <td style='vertical-align: middle; width: 10.1%;'><form action = 'includes/edit_form.inc.php' method = 'POST' id='edit_form'>
                            <input type='text' hidden name= 'training_id' value = '$row[training_id]'><button type='submit' class='btn-link'>" . $row["training_id"] .  "</button>
                            </form>
                            </td>
                            <td style='vertical-align: middle; font-size:20px; width:10.2%;'><a href = 'pdf_preview.php?training_id=$row[training_id]' target='_blank'><i class='bi bi-file-pdf'></i></a></button>
                            </td>
                            <td style='vertical-align: middle; width: 10.2%;'>" . $row["name_"] .  "</td>
                            <td style='vertical-align: middle; width: 20.3%; word-break: break-all'>" . $row["training_name"] .  "</td>
                            <td style='vertical-align: middle; width: 10.2%; word-break: break-all'>  
                           "; 

                         

                            foreach($result3 as $row_file) {
                                
                                    $output .= "$row_file[category_name]<br>";
                                    }

             /*   foreach($result3 as $row_file) {
                    $file_path = "includes/uploads/" . $row_file["file_name"] . "." . $row_file["file_ext"];
                
                    $file_name = $row_file["file_name"] . "." . $row_file["file_ext"];
    
                    $output .= " <td> <a href = $file_path download>$file_name</a><br></td>";
                    } */
            
            $output .= "    </td> 
                            <td style='vertical-align: middle; width: 10.2%;'>" . $row["usage_id"] .  "</td>
                            <td style='vertical-align: middle; width:15.1% ;'>" . $row["status_name"] .  "</td>
                            <td style='vertical-align: middle; width:13.7% ;'>
                            <form action='includes/documentNo.inc.php' method ='POST'>
                            <input type='text' hidden value='$row[training_id]' name='documentNo'>             
                            <button type='submit' class='btn btn-primary'><span>サイン</span></button>
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


