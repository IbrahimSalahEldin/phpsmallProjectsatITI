<?php
include 'connect_to_db.php';



echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo'<link rel="stylesheet" href="Style.css">';
echo "<div class='container'> ";
echo "<div class='d-flex justify-content-center m-4 text';'><h2>Users Data</h2></div>";



try{
    $db = connect_to_db();
    if($db){

        $query = "select * from `Users`";
        $select_stmt = $db->prepare($query);
        $res=$select_stmt->execute();
        $data = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table class='table' style='border:solid 5px orange'> <tr><th>ID</th>  <th>First Name</th><th>Last Name</th>  <th>Email</th> <th>Image</th>
            <th>Edit</th>  <th>Delete</th> 
        </tr>";

    foreach ($data as $row){
        $i=0;
        echo "<tr>";
        foreach ($row as $element){
            if($i>3)
            continue;
            $i++;
            echo "<td>{$element} </td>";
        }
        
        echo " <td> <img width='100' height='100'  src='{$row['img']}'> </td> 
        <td> <a href='edit.php?id={$row['id']}' class='btn btn-warning'> Edit </a> </td>
        <td> <a href='delete.php?id={$row['id']}' class='btn btn-danger'> Delete </a> </td>";
        echo "</tr>";
    }

    echo "</table>";


    }

}catch (Exception $e){
    echo $e->getMessage();
}

 echo "<a href='form.php' class='btn btn-primary'>Add new user </a>";