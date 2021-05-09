<?php
    // include necessary files
    include "../classes/Database.php";  // user-defined class to connect to database
    include "../classes/User.php";     // user-defined class to support user functions

    // php file to create user

    // validating fields
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // echo $firstName." ".$lastName;   // DEBUG

    // creating user
    // connecting to database
    $hostName = "localhost";
    $db_name = "interview_buzztro";  // name of the database consisting relevant tables
    $user = "webuser";
    $pass = "P@ssw0rd";

    // creating database object
    $db = new Database($hostName, $db_name, $user, $pass);
    $pdo = $db->connect_to_db();  // returns PDO object

    // creating user object
    $new_user = new User();
    $flag = $new_user->createUser($firstName, $lastName, $email, $password, $pdo);     // insert user data into database

    if($flag == -1){
        echo "user already exists";
    }
    else if($flag == 0){
        echo "An unexpected error occurred";
    }
    if($flag == 1){
        echo "user created successfully";
    }

?>