<?php
    // homepage for admin
    session_start();
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're looking for</h2>";
    }   
    else{
        echo "<h1>Hello, admin</h1>";
        echo "<h3> username: ".$_SESSION['username']."</h3>";
        echo "<ul style=\"margin-bottom: 20px; font-size: 20px\">
                <li style=\"margin: 10px;\"> <a href=\"addProduct.php\">Add Product</a> </li>
                <li style=\"margin: 10px;\"> <a href=\"viewProduct_Form.php\">View Product</a> </li>
                <li style=\"margin: 10px;\"> <a href=\"updateProduct.php\">Update Product</a> </li>
                <li style=\"margin: 10px;\"> <a href=\"deleteProduct.php\">Delete Product</a> </li>
              </ul>";
        echo "<p style=\"margin: 10px; font-size: 20px\"> <a href=\"viewOrders.php\">View Orders</a> </p>";
        echo "<p style=\"margin: 10px; font-size: 20px\"> <a href=\"adminLogout.php\">Log out </a> </p>";
    }



?>