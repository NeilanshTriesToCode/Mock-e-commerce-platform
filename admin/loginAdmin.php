<?php
    // include necessary files
    include "../classes/Database.php";  // user-defined class to connect to database
    include "../classes/Admin.php";     // user-defined class to support user functions

    // php file to create user

    // validating fields
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

   // echo  "<h3>hello ".$username."</h3>";  // DEBUG

    // loggin in admin
    // connecting to database
    $hostName = "localhost";
    $db_name = "interview_buzztro";  // name of the database consisting relevant tables
    $user = "webuser";
    $pass = "P@ssw0rd";

    // creating database object
    $db = new Database($hostName, $db_name, $user, $pass);
    $pdo = $db->connect_to_db();  // returns PDO object

    // creating user object
    $new_admin = new Admin();
    $flag = $new_admin->loginAdmin($username, $email, $password, $pdo);     // login user

    if($flag == 1){
        session_start();   // starting session 
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['userType'] = 1;  // 1 indicates admin, 2 indicates user/customer
        //header('Location: ./userHome.php');      // redirect user to user homepage (to be implemented)
        echo "Logged in successfully";
    }
    else if($flag == 0){
        echo "Incorrect email/password";
    }
  

?>