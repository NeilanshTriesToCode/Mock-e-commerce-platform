<?php
    // directed when user successfully logs in
    session_start();   // starting session
    include('../header.php');
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Page not found";
    }
    else{
        session_destroy();
        echo "<h3> You have been successfully logged out.  </h3>";
        echo "<h3> <a href = \"login.html\">Login</a>";
    }
?>