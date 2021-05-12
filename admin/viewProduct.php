<?php
    // php file to display products
    session_start();
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're loooking for</h2>";
    }  
    else if(!empty($_POST) && ($_SESSION['userType'] == 1)){
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";

        // getting fields
        $p_id = $_POST['p_id'];
        $p_name = $_POST['p_name'];

        // connecting to database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();

        // create product object
        $product = new Product();
        if( $product->getProduct($p_id, $p_name, $pdo) ){  // if a product exists
            echo "<style>
                table { 
                    border: 1pt solid black; 
                    border-collapse: collapse;
                    border-spacing: 10pt
                }
                td {
                    border: 1pt solid black; 
                    padding: 20px
                }
                </style>";
            echo "<table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>img_1</th>
                            <th>img_2</th>
                        </tr>
                    </thead>    
                    
                        <tr>
                            <td>".$product->id."</td>
                            <td>".$product->p_name."</td>
                            <td>".$product->p_description."</td>
                            <td>".$product->category."</td>
                            <td>$".$product->price."</td>
                            <td>".$product->stock."</td>
                            <td> <img src = \"data:image/jpg;base64,'".base64_encode($product->img_1)."'\" width = \"50px\" height = \"50px\"/> </td>
                            <td> <img src = \"data:image/jpg;base64,'".base64_encode($product->img_1)."'\" width = \"50px\" height = \"50px\"/> </td>
                            </tr>
                    
                 </table>"; 
                 
        }
        else{
            echo "Product not found";
        }

    }



?>
