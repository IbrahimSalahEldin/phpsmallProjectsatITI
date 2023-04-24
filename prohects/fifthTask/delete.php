<?php

// include "connect_to_db.php";
include "DataBaseClass.php";
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<h1>update user  </h1>";

$id= $_GET['id'];
try{
    $objDB = new DataBase();
    if($objDB){
        $stmt=$objDB->delete('Users',$id);
        if($stmt){
            echo "deleted successfully";
            header("Location:datatable.php");
        }


    }

}catch(Exception $e){
    echo $e->getMessage();
}