<?php
    // homepage for admin
    session_start();
    include('../header.php');

    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're looking for</h2>";
    }   
    else{
        echo "<h1>Hello, admin</h1>";
        echo "<h3 id='greeting'> username: ".$_SESSION['username']."</h3>";
        echo "<div class='option_container'>
                <button onclick=\"document.location='addProduct.php'\" class='options'> Add Product </button><br>

                <button onclick=\"document.location='viewProduct_Form.php'\" class='options'> View Product </button><br>

                <button onclick=\"document.location='updateProduct.php'\" class='options'> Update Product </button><br>
                
                <button onclick=\"document.location='deleteProduct.php'\" class='options'> Delete Product </button><br>
                
                <button onclick=\"document.location='viewOrders.php'\" class='options'> View Orders </button><br>

                <button onclick=\"document.location='adminLogout.php'\" class='options'> Log out </button><br>
             </div>";
       
    }



?>