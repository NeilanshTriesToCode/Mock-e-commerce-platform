<?php
    // directed when user successfully logs in
    session_start();   // starting session
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Log In to see this page";
        echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }

    else{
        $email = $_SESSION['email'];
        echo "<h2>Home</h2><br>";
        echo "<h4>Hi ".$email."</h4> ";
       // session_destroy();  // to logout
    }
   

?>