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
      echo "<h1>User Login </h1>";
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
            <form action="validatelogin.php" method="POST"  enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email"  
                      value="<?php if(isset($old_data['useremail'])) echo $old_data['useremail']; ?>">
                      <span class="text-danger"> <?php if(isset($errors['useremail'])) echo $errors['useremail']; ?> </span>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="password" name="password">
                      <span class="text-danger"> <?php if(isset($errors['userpassword'])) echo $errors['userpassword']; ?> </span>
                    </div>
                  </div>
                  <div class="row mb-3 d-flex justify-content-around">
                    <button type="submit" class="btn btn-primary w-25">login</button>
                     <button type="reset" class="btn btn-primary w-25">Reset</button>
                  </div>
              </form>
        </div>
    </div>
</body>
</html>