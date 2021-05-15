<?php
    // directed when user successfully logs in
    session_start();   // starting session
    include('../header.php');
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Log In to see this page";
        echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }
    else{
        // php file to show customer's orders
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";     // user-defined class to manipulate products table
        include "../classes/User.php";     // user-defined class to access user functions
        include "../classes/Order.php";     // user-defined class to access user functions
 
        // get user email from session info
        $email = $_SESSION['email'];
 
        // connecting to database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";
 
        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();

        // create user object
        $user = new User();
        $flag_1 = $user->getUserInfo($email, $pdo);

        // create order object
        $order = new Order();

        if($flag_1){
            $cust_id = $user->id;  // user id
            $statement = $order->getUserOrders($cust_id, $pdo);   // returns statement
            if($statement == -1){
                echo "<script> alert('you have no orders'); </script>";
            }
            else{          
                echo "<style>
                    #name {
                        font-style: italic
                        padding: 2px
                    }
                </style>";


                echo "<div id='orders'>";

                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    echo "<div class='container'>
                            <p id=\"name\" style=\"font-size: 25px; font-weight:bold\">".$row['product_name']."</p>
                            <p id='price'>Price: $".$row['price'].".00</p> 
                            <p id='date' style=\"font-style:italic\">Ordered on: ".$row['order_date']."</p> 
                        </div>
                        <hr>";
                }
                echo "</div>";
            }
            echo "<h3> <a href=\"userHome.php\">Back to Home</a> </h3>";
        }

     }



?>