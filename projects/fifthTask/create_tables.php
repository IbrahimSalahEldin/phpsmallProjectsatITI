<?php

include "connect_to_db.php";

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<h1>Create Tables  </h1>";

try{
    $db = connect_to_db();
    if($db){
        $query = "CREATE table if not exists `Users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `firstName` VARCHAR(30) NOT NULL,
            `lastName` VARCHAR(30) NOT NULL,
            `email` VARCHAR(50) NOT NULL,
            `password` VARCHAR(50) NOT NULL,
            `img` varchar(255)
            )";
            
            $select_stmt = $db->prepare($query);
            // $res=$select_stmt->execute();
            if($select_stmt->execute()){
                echo"table created <br>";
            }
    }
    
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>