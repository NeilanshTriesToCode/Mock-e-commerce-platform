<?php
    session_start();
    include('../header.php');
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        header('Location: adminHome.php');  // redirect to adminHome which prints error message
    }  
    else{   // free resources
        echo "<h2> Logged out successfully </h2>";
        session_destroy();
        echo "<h3> <a href=\"adminLogin.html\">Back to login page</a> <h3>";
    }
?>