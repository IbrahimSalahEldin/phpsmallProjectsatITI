<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
echo "<h1>Save user  </h1>";

// var_dump($_POST);
$email = $_POST["email"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$address = $_POST["address"];
$department = $_POST["department"];
$skills = $_POST["Skills"];
$gender = $_POST["Gender"];

// var_dump(empty($useremail) and isset($useremail));

$errors =[];
$formdata = [];
if(empty($firstName) and isset($lastName)and isset($email)){

    $errors['firstName']='first name required';
}else{
    $formdata["firstName"]= $firstName;
}
if(empty($lastName) and isset($firstName) and  isset($email)){

    $errors['lastName']='last name required';
}else{
    $formdata["lastName"]= $lastName;
}
if(empty($email) and isset($firstName) and  isset($lastName)){

    $errors['email']='email required';
}else{
    $formdata["email"]= $email;
}

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
### I need to save the users data to the file

    try {
        if($_POST["id"]){
            $fileobj = fopen('users.txt', 'a');
            $id=$_POST["id"];
            $user_data = "{$id}:{$firstName}:{$lastName}:{$email}:{$address}:{$department}:{$gender}" . PHP_EOL;
            fwrite($fileobj, $user_data);
            fclose($fileobj);
            header('Location:userData.php');
        }
        else{
            $fileobj = fopen('users.txt', 'a');

            $id = time();
            $user_data = "{$id}:{$firstName}:{$lastName}:{$email}:{$address}:{$department}:{$gender}" . PHP_EOL;
            fwrite($fileobj, $user_data);
            fclose($fileobj);
    
          header('Location:userData.php');
        }

//    readfile('users.txt');

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ################## validation --> must be implement frontend and backend and database