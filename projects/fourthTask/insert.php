<?php

///connect by DataBase 
include "connect_to_db.php";



//using bootsrap
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<h1>Insert Data</h1>";




//assign values to variables 

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

//check to validatgion  of values

$errors =[];
$formdata = [];

if(empty($firstName) and isset($lastName)and isset($email)& isset($password)){

    $errors['firstName']='first name required';
}else{
    $formdata["firstName"]= $firstName;
}
if(empty($lastName) and isset($firstName) and  isset($email)& isset($password)){

    $errors['lastName']='last name required';
}else{
    $formdata["lastName"]= $lastName;
}
if(empty($email) and isset($firstName) and  isset($lastName)& isset($password)){

    $errors['email']='email required';
}else{
    $formdata["email"]= $email;
}
if(empty($password) and isset($firstName) and  isset($lastName)& isset($password)){
    $errors['password']='password required';
}



//use DataBase to insert vakues into table
if($errors){
    $errors_str= json_encode($errors);
    var_dump($errors_str);
    
    $url="Location:form.php?errors={$errors_str}";

    if($formdata){
        $old_data= json_encode($formdata);
        $url .="&old={$old_data}";
    }
    header($url);
}else {
try{
    $db = connect_to_db();
    if($db){
        $select_query= "Insert INTO `Users` (`firstName`, `lastName`, `email`, `password`,`img`) Values(:fname,:lname,:email,:password,:img)";
        $stmt = $db->prepare($select_query);
        $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':img', $image_new_name, PDO::PARAM_STR);
        $res = $stmt->execute();

        if($stmt->rowCount()){
            echo " Data inserted ";

            header("Location:datatable.php");
        }


    }

}catch(Exception $e){
    echo $e->getMessage();
}
}


?>