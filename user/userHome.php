<?php
    // directed when user successfully logs in
    session_start();   // starting session
    include('../header.php');
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Log In to see this page";
        echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }
    else{
        $email = $_SESSION['email'];
        echo "<h2>Home</h2>";
        echo "<h3 id='greeting'>Hi ".$email."</h3>";
        echo "<div class='option_container'>
                <button onclick=\"document.location='viewProducts.php'\" class='options'> View Products </button><br>

                <button onclick=\"document.location='myOrders.php'\" class='options'> My Orders </button><br>

                <button onclick=\"document.location='userLogout.php'\" class='options'> Logout </button><br> 
              </div>";
    }
   

?>