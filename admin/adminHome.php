<?php
    // homepage for admin
    session_start();
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're loooking for</h2>";
    }   
    else{
        echo "<h1>Hello, admin</h1>";
        echo "<h3> username: ".$_SESSION['username']."</h3>";
        echo "<ul>
                <li>Add Products</li>
                <li>View Products</li>
                <li>Update Product</li>
                <li>Delete Product</li>
              </ul>";
        echo "<p>View Orders</p>";
        echo "<p>Log out</p>";




    }



?>