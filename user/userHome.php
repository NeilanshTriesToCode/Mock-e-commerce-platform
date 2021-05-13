<?php
    // directed when user successfully logs in
    session_start();   // starting session
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Log In to see this page";
        echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }
    else{
        $email = $_SESSION['email'];
        echo "<h2>Home</h2>";
        echo "<h3>Hi ".$email."</h3>";
        echo "<ul style=\"margin-bottom: 20px; font-size: 20px\">
                <li style=\"margin: 10px;\"> <a href=\"viewProducts.php\">View Products</a> </li>
                <li style=\"margin: 10px;\"> <a href=\"myOrders.php\">My Orders</a> </li>
                <li style=\"margin: 10px;\"> <a href=\"userLogout.php\">Logout</a> </li>
              </ul>";
    }
   

?>