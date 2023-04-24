<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
echo "<h1>Save user  </h1>";

// var_dump($_POST);
$email = $_POST["email"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$password = $_POST["password"];


// var_dump(empty($useremail) and isset($useremail));

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
            $image_new_name ='';
            if(isset($_FILES['image']) and ! empty($_FILES['image']['name'])){
                $imagename= $_FILES["image"]['name'];
                var_dump($imagename);
                $tmp_name = $_FILES['image']['tmp_name'];
                $ext = pathinfo($imagename)['extension'];
                var_dump($ext);
                $image_new_name = "images/{$id}.{$ext}";
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
            $user_data = "{$id}:{$firstName}:{$lastName}:{$email}:{$image_new_name}:{$password}" . PHP_EOL;
            fwrite($fileobj, $user_data);
            fclose($fileobj);
            header('Location:userData.php');
        }
        else{
            $fileobj = fopen('users.txt', 'a');
            $id = time();
            $image_new_name ='';

            if(isset($_FILES['image']) and ! empty($_FILES['image']['name'])){
                $imagename= $_FILES["image"]['name'];
                var_dump($imagename);
                $tmp_name = $_FILES['image']['tmp_name'];
                $ext = pathinfo($imagename)['extension'];
                var_dump($ext);
                $image_new_name = "images/{$id}.{$ext}";
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
            $user_data = "{$id}:{$firstName}:{$lastName}:{$email}:{$image_new_name}:{$password}" . PHP_EOL;
            fwrite($fileobj, $user_data);
            fclose($fileobj);
    
          header('Location:userData.php');
        }



    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ################## validation --> must be implement frontend and backend and database
// try {

//     $fileobj = fopen('users.txt', 'a');

//     $id = time();

//     $image_new_name ='';

//     if(isset($_FILES['image']) and ! empty($_FILES['image']['name'])){
//         $imagename= $_FILES["image"]['name'];
//         var_dump($imagename);
//         $tmp_name = $_FILES['image']['tmp_name'];
//         $ext = pathinfo($imagename)['extension'];
//         var_dump($ext);
//         $image_new_name = "images/{$id}.{$ext}";
//         if (in_array($ext,['png', 'jpg'])){
//             try{
//                 $uploaded = move_uploaded_file($tmp_name,"$image_new_name");
//                 var_dump($uploaded);
//             } catch (Exception $e){
//                 var_dump($e->getMessage());
//                 exit;

//             }


//         }
//     }

//     $user_data = "{$id}:{$_POST["email"]}:{$_POST["password"]}:{$image_new_name}" . PHP_EOL;
//     fwrite($fileobj, $user_data);
//     fclose($fileobj);
//     header('Location:userstable.php');
// //    readfile('users.txt');

// } catch (Exception $e) {
//     echo $e->getMessage();
// }