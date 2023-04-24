<?php
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
    var_dump($_POST);
        echo "<div class='container pt-5 d-flex'  >";
        echo "<div class='row d-flex hustify-content-center w-75 m-auto'  >";
        echo "<h1> User Page </h1>";
        $email = $_POST["email"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $address = $_POST["address"];
        $department = $_POST["department"];
        $skills = $_POST["Skills"];
        $gender = $_POST["Gender"];
        if($gender=="Male")
          echo "thanks mr " . $firstName ." " . $lastName ."<br>";
          else
          echo "thanks mrs " . $firstName ." " . $lastName ."<br>";
          
          echo "<h2 class='m-3'>Please Review Your Information</h3>";
          echo "<div class='m-3'>";
          echo "Name :  " . $firstName . " " . $lastName."<br>";
          echo "Address :  " . $address ."<br>";
          echo "Skills :  <br>";
          foreach ($skills as $value) {
            echo $value ."<br>";
          }
          echo "Department :  " . $department ."<br>";