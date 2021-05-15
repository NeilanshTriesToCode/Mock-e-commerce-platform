<?php
    // directed when user successfully logs in
    session_start();   // starting session
    include('../header.php');
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Log In to see this page";
        echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }
    else{
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";
        // display products in tabular form

        // connecting to the database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();

        // create product object
        $product = new Product();
        $statement = $product->getAllProducts($pdo);

        echo "<h2> <a href=\"userHome.php\">Back to Home</a> </h2>";

        // styles for displaying product

        echo "<div id='Products'>";

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='products_container'>
                    <div class='items'> 
                        <p id='name'>".$row['p_name']."</p> 
                        <p id='desc'>Description: ".$row['p_description']."</p> 
                        <p>Category: ".$row['category']."</p> 
                        <p>Price: $".$row['price'].".00</p>      
                        <button class='order_button' onclick=\"document.location='orderProduct.php?p_id=".$row['id']."'\"> Order </button>               
                    </div>

                    <div class='images_container'> 
                        <img class='product_images' src = '../product_images/".$row['img_1']."'/> 
                        <img class='product_images' src = '../product_images/".$row['img_2']."'/> 
                    </div>                 
                  </div>
                  <hr>";
        }
        echo "</div>";
    }

?>