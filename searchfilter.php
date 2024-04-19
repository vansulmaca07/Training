<?php

    include('includes/dbh2.inc.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Icon Scout-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="wrapper">
        <div class="select-btn">
            <span>Select Instructor</span>
            <i class="uil uil-angle-down"></i>
        </div>
        <div class="content">
            <div class="search">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search">
            </div>
            <ul class="options">
            <?php
                    $query = "SELECT name_ from users
                        WHERE userlevel ='2'
                        ;";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        $php_array = [];
                        foreach($result as $row)
                        {
                            echo "
                                <li>$row[name_]</li>
                            ";
                            $php_array[]=$row["name_"];
                        }
                ?>
            </ul>
        </div>
    </div>

<script>

const wrapper = document.querySelector(".wrapper"),
selectBtn = wrapper.querySelector(".select-btn");
selectBtn.addEventListener("click", () => {
wrapper.classList.toggle("active");
});

var jArray = <?php echo json_encode($php_array); ?>;

for(var i=0; i<jArray.length; i++){
    alert(jArray[i]);
}


</script>

</body>
</html>


