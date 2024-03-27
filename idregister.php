<?php

session_start()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        
<div class="idregistration" id="idregistration">
            <h4>IDカード登録</h4>
            <h5>Please confirm the following</h5>
            <div id="table-wrapper5">
                <div id="table-scroll5">
                    <table id="IDregTable" border="1" class="IDregT">
                        <thead>
                    <tr id="firstrow">
                    <th style="width:25%">GID</th>
                    <th style="width:25%">名前</th>
                    <th style="width:25%">工程</th> <!--process--> 
                    </thead>
                    
                    <?php
                    $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "trainingdb";
                        
                        //Create connection

                        $connection = new mysqli($servername, $username, $password, $database);

                        //Check connection

                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        
                        //read all row from database table

                        //$sql = "SELECT * FROM '{$_SESSION["documentNo"]}'";
                        $sql = "SELECT * FROM users where department = '1' AND GID = 'jt9970440'";
                        
                        $result = $connection->query($sql);
                        
                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        //read data of each row
                        while ($row = $result->fetch_assoc()){

                        echo "<tr>
                            <td>" . $row["GID"] .  "</td>
                            <td>" . $row["firstname"] .  "</td>
                            <td>" . $row["department"] .  "</td>";
                                        
                        }
                        
                        ?>
                        <form action="includes/idregister.php" method="post"> 
                        <label for="IDregistrationInput"></label>
                        <input type="text" id="IDregistrationInput" class="IDregistrationInput" name="IDregistrationInput" value="" placeholder="Please Tap your ID">
                        <input type="submit" class="btn2" id="submit" name="submit">
                        </form>
                        

    
</body>
</html>
