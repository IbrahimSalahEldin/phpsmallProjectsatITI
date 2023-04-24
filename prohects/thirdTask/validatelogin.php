<?php

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
    echo "<h1>Check login  </h1>";

    $useremail = $_POST["email"];
    $userpassword = $_POST["password"];
    // var_dump(empty($useremail) and isset($useremail));

    $errors =[];
    $formdata = [];

    if(empty($useremail) and isset($userpassword)){
    
        $errors['useremail']='email required';
    }else{
        $formdata["useremail"]= $useremail;
    }
    if(empty($userpassword) and isset($useremail)){
    
        $errors['userpassword']='password required';
    }
    
    if($errors){
        $errors_str= json_encode($errors);
        var_dump($errors_str);
        $url="Location:login.php?errors={$errors_str}";
    
        if($formdata){
            $old_data= json_encode($formdata);
            $url .="&old={$old_data}";
        }
        header($url);
    }else {
        $logged_in= false;
        $users= file("users.txt");
        foreach ($users as $index=>$user){
            echo $user,'<br>';
            $users_data = explode(':', $user);
            if($users_data[3]==$useremail and $users_data[5]==$userpassword){
                echo 'Logged in successed';
                $logged_in= true;
                header("Location:userhomepage.php?message=loginSuccess");
                break;
            }

        }

        if($logged_in){
            session_start();
            $_SESSION['user_email']=$useremail;
            $_SESSION['login']=true;

        }else{
            header("Location:login.php?error=invalidemailpassword");
            exit;
        }


    }