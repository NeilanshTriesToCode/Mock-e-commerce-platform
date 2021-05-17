<?php
    // directed when user successfully logs in
    session_start();   // starting session
    include('../header.php');
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
         echo "Log In to see this page";
         echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }
    else{
        // php file to order product
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";     // user-defined class to manipulate products table
        include "../classes/User.php";     // user-defined class to access user functions
        include "../classes/Order.php";     // user-defined class to access user functions

        // receive product id from referring page
        $p_id = $_GET['p_id'];
        // get user email from session info
        $email = $_SESSION['email'];

        // connecting to database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();

        // create product object
        $product = new Product();
        $flag_1 = $product->getProductWithId($p_id, $pdo);  // get product info

        // create user object
        $user = new User();
        $flag_2 = $user->getUserInfo($email, $pdo);

        // create order object
        $order = new Order();

        if($flag_1 && $flag_2){
            $product_id = $product->id;
            $product_name = $product->p_name;
            $price = $product->price;
            $cust_id = $user->id;
            $flag = $order->createOrder($product_id, $cust_id, $product_name, $price, $pdo);  // create order

            echo "<button onclick='document.location=\"userHome.php\"'>Back</button>";

            if($flag == 1){
                echo "<script> alert('Order created'); </script>";
            }
            else{
                echo "<script> alert('Couldn't create order'); </script>";
            }
        }
        else{
            echo "<script> alert('An unknown error occurred'); </script>";
        }
    }
?>