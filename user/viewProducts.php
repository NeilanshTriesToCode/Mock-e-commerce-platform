<?php
    // directed when user successfully logs in
    session_start();   // starting session
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
        echo "<style>
                div { 
                    margin: 10px
                }
                p {
                    font-size: 20px;
                    padding: 2px
                }
                #name {
                    font-style: italic
                    padding: 2px
                }
              </style>";

        echo "<div id='Products'>";

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            echo "<div id='container'>
                    <p id='name' style=\"font-size: 25px; font-weight:bold;\">".$row['p_name']."</p>
                    <p id='desc' style=\"font-style:italic\">Description: ".$row['p_description']."</p>
                    <p id='category'>Category: ".$row['category']."</p>
                    <p id='price'>Price: $".$row['price'].".00</p> 
                    <p id='images'> 
                    <td> <img src = '../product_images/".$row['img_1']."'\" width = \"250px\" height = \"250px\"/> </td>
                    <td> <img src = '../product_images/".$row['img_2']."'\" width = \"250px\" height = \"250px\"/> </td>
                    </p>
                    <p>
                        <a href=\"orderProduct.php?p_id=".$row['id']."\">Order</a> 
                    </p>          
                  </div>
                  <hr>";
        }
        echo "</div>";
    }

?>