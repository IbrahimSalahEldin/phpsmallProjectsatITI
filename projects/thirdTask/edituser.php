<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<h1>Edit user </h1>";
// var_dump($_GET);
// var_dump($editFormData);
// var_dump($users);
if(isset($_GET["errors"])){
    //        var_dump($_GET);
            $errors = json_decode($_GET["errors"], true);
    //        var_dump($errors);
        }
        if(isset($_GET["old"])){
        //        var_dump($_GET);
            $old_data = json_decode($_GET["old"], true);
        //        var_dump($old);
        }
$user_id = $_GET["id"]; 
$firstName = trim(strip_tags($_GET['firstName']));
$lastName = trim(strip_tags($_GET['lastName']));
$email = trim(strip_tags($_GET['email']));

$editFormData = [ "id"=>$user_id, "firstName"=>$firstName,"lastName"=>$lastName,"email"=>$email];
$users=  file('users.txt');

foreach ($users as $index=>$user){
    // echo $user, $index, '<br>';
    $users_data = explode(':', $user);
    if($users_data[0]==$user_id){
        unset($users[$index]);  # delete from the array
        break;
    }

}

// var_dump($users);

$fileobj = fopen("users.txt", 'w');
foreach ($users as $user){
    fwrite($fileobj, $user);
}
fclose($fileobj);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container d-flex justify-content-center p-auto mt-5">
        <div class="row w-50 ">
            <form action='savedata.php' method="post">
            <div class="row mb-3">
            <input type="text" class="form-control" id="id" name="id" hidden
                    value="<?php if  (isset($editFormData['id'])) echo $editFormData['id']; 
                    ?>"
             >
            </div>
                <div class="row mb-3">
                  <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="first_name" name="firstName" 
                    value="<?php if(isset($old_data['firstName'])) echo $old_data['firstName'];
                      else if  (isset($editFormData['firstName'])) echo $editFormData['firstName']; 
                    ?>"
                    >
                    <span class="text-danger"> <?php if(isset($errors['firstName'])) echo $errors['firstName']; ?> </span>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="last_name" name="lastName" 
                      value="<?php if(isset($old_data['lastName'])) echo $old_data['lastName'];
                        else if  (isset($editFormData['lastName'])) echo $editFormData['lastName']; 
                       ?>">
                      <span class="text-danger"> <?php if(isset($errors['lastName'])) echo $errors['lastName']; ?> </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email"  
                      value="<?php if(isset($old_data['email'])) echo $old_data['email']; 
                      else if  (isset($editFormData['email'])) echo $editFormData['email']; 
                      ?>">
                      <span class="text-danger"> <?php if(isset($errors['email'])) echo $errors['email']; ?> </span>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="password" name="password">
                      <span class="text-danger"> <?php if(isset($errors['password'])) echo $errors['password']; ?> </span>
                    </div>
                  </div>
                  <div class="row mb-3 d-flex justify-content-around">
                    <button type="submit" class="btn btn-primary w-25"  href='savedata.php?id={$users_data[0]}'>Update</button>
                     <button type="reset" class="btn btn-primary w-25">Reset</button>
                  </div>

              </form>
        </div>
    </div>
</body>
</html>