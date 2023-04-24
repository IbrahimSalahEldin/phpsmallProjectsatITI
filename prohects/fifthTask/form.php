<?php

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
    echo "<div class='d-flex justify-content-center m-4 text';'><h2>User Register</h2></div>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
    <title>DataBase</title>
</head>
<body>
    <div class="container d-flex justify-content-center p-auto ">
        <div class="row w-50 p-5 mb-5 main" >
            <form action="insert.php" method="POST"  enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="first_name" name="firstName"
                    value="<?php if(isset($old_data['firstName'])) echo $old_data['firstName'];?>">
                    <span class="text-danger"> <?php if(isset($errors['firstName'])) echo $errors['firstName']; ?> </span>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="last_name" name="lastName"
                      value="<?php if(isset($old_data['lastName'])) echo $old_data['lastName'];?>">
                      <span class="text-danger"> <?php if(isset($errors['lastName'])) echo $errors['lastName']; ?> </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email"
                      value="<?php if(isset($old_data['email'])) echo $old_data['email']; 
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
                  <div class=" row mb-3">
                  <label class="form-label">User Image </label>
                  <input type="file" name="image" class="btn img">
                    </div>
                  <div class="row mb-3 d-flex justify-content-around">
                    <button type="submit" class="btn btn-primary RegisterBtn w-50 mt-2">Register</button>
                  </div>
              </form>
              <!-- <a class="btn btn-primary w-100" href="login.php">Login </a> -->
        </div>
    </div>
</body>
</html>