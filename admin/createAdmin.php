<?php
    // php file to create admin account

    // include necessary files
    include "../classes/Database.php";  // user-defined class to connect to database
    include "../classes/Admin.php";     // user-defined class to support user functions

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   // echo  "<h3>hello ".$username."</h3>";  // DEBUG

    // creating admin account
    // connecting to database
    $hostName = "localhost";
    $db_name = "interview_buzztro";  // name of the database containing relevant tables
    $user = "webuser";
    $pass = "P@ssw0rd";

    // creating database object
    $db = new Database($hostName, $db_name, $user, $pass);
    $pdo = $db->connect_to_db();  // returns PDO object

    // creating user object
    $new_admin = new Admin();
    $flag = $new_admin->createAdmin($username, $email, $password, $pdo);     // insert user data into database

    if($flag == -1){
        echo "admin already exists";
    }
    else if($flag == 0){
        echo "An unexpected error occurred";
    }
    if($flag == 1){
        echo "<h2>Admin created successfully<h2>";
        echo "<h2> <a href=\"AdminLogin.html\">Login here</a> <h2>";
    }
    
?>


