<?php

// include 'connect_to_db.php';
include 'DataBaseClass.php';

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<div class='d-flex justify-content-center m-4 text';'><h2>User Update</h2></div>";
## 1- get old data

if(isset($_GET['id'])){
    $id = $_GET['id'];
    ## connect to databse ==

    try{

        // $db = connect_to_db();
        $objDB = new DataBase();
        if($objDB){
            // $select_query= "Select * from Users where id=:id";
            // $stmt = $db->prepare($select_query);
            // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // $res = $stmt->execute();
            // $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $Srow=$objDB->select("Users");
            $row=$Srow[0];
            if($row){
              //  var_dump($row);
            }else{
                header("Location:datatable.php");
            }
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }



}else{
    exit;
}

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
    <div class="container d-flex justify-content-center p-auto mt-5">
        <div class="row w-50 p-5 main">
            <form action="update.php?id=<?php echo $row['id'] ?>" method="POST"  enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="first_name" name="firstName" value="<?php echo $row['firstName']?>">
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="last_name" name="lastName" value="<?php echo $row['lastName']?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                  </div>
                  <div class=" row mb-3">
                  <label class="form-label">User Image </label>
                  <input type="file" name="image" class="btn img">
                    </div>
                  <div class="row mb-3 d-flex justify-content-around">
                    <button type="submit" class="btn btn-primary w-50 RegisterBtn">Update</button>
                  </div>
              </form>
              <!-- <a class="btn btn-primary w-100" href="login.php">Login </a> -->
        </div>
    </div>
</body>
</html>