<?php
const DB_HOST = "localhost";
const DB_USER ="root";
const DB_PASSWORD = "";
const DB_DATABASE = "crudoperations";


function connect_to_db(){

    try {

        $dsn ='mysql:dbname=crudoperations;host=127.0.0.1;port=3306;';
        $db = new PDO($dsn, DB_USER, DB_PASSWORD);
        return $db;

        } catch (Exception $e){
                echo $e->getMessage();
    }
}

// var_dump(connect_to_db());

 

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     die("ERROR: Could not connect to the database. " . $e->getMessage());
// }

// Step 2: Define a SQL statement that creates the table
// $sql = "CREATE TABLE users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     firstname VARCHAR(30) NOT NULL,
//     lastname VARCHAR(30) NOT NULL,
//     email VARCHAR(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// // Step 3: Prepare the SQL statement using the PDO prepare() method
// $stmt = $pdo->prepare($sql);

// // Step 4: Execute the prepared statement using the PDO execute() method
// if ($stmt->execute()) {
//     echo "Table created successfully.";
// } else {
//     echo "ERROR: Could not execute the statement. " . $stmt->errorInfo();
// }
