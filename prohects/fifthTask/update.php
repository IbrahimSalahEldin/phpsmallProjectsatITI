<?php

include "connect_to_db.php";
include "DataBaseClass.php";
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<h1>update user  </h1>";

var_dump($_REQUEST);
$id= $_GET['id'];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];
$image_new_name ='';
$imgn=time();
if(isset($_FILES['image']) and ! empty($_FILES['image']['name'])){
    $imagename= $_FILES["image"]['name'];
    var_dump($imagename);
    $tmp_name = $_FILES['image']['tmp_name'];
    $ext = pathinfo($imagename)['extension'];
    var_dump($ext);
    $image_new_name = "images/{$imgn}.{$ext}";
    if (in_array($ext,['png', 'jpg'])){
        try{
            $uploaded = move_uploaded_file($tmp_name,"$image_new_name");
            var_dump($uploaded);
        } catch (Exception $e){
            var_dump($e->getMessage());
            exit;

        }


    }
}
try{
    // $db = connect_to_db();
    $objDB = new DataBase();
    if($objDB){
        $fields = ['firstName'=>$firstName,'lastName'=>$lastName,'email'=>$email,'password'=>$password,'img'=>$image_new_name];
        $id= $objDB->update('Users',$id,$fields);
        if($id){
            echo "updated ";
            header("Location:datatable.php");
        }


    }

}catch(Exception $e){
    echo $e->getMessage();
}