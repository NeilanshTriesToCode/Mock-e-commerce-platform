<?php
    // include necessary files
    include "../classes/Database.php";  // user-defined class to connect to database
    include "../classes/User.php";     // user-defined class to support user functions

    // php file to create user

    // validating fields
    $email = $_POST['email'];
    $password = $_POST['password'];

    // echo $email." ".$password;   // DEBUG

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
    $flag = $new_user->loginUser($email, $password, $pdo);     // login user

    if($flag == 1){
        echo "Logged in successfully";
    }
    else if($flag == 0){
        echo "Incorrect email/password";
    }
  

?>