<?php
    // php file to delete product
    session_start();
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        header('Location: adminHome.php');  // redirect to adminHome which prints error message
    } 
    else if(!empty($_POST) && ($_SESSION['userType'] == 1)){
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";     // user-defined class to manipulate products table
        
        // get product id
        $p_id = $_POST['p_id'];

        // connecting to the database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        // creating database object
        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();  // returns PDO object

        $product = new Product();
        if($product->getProductWithId($p_id, $pdo)){ // display deleted product details
            if($product->deleteProduct($p_id, $pdo) == 1){
                echo "<script> alert('Product with id ".$p_id." deleted'); </script>";
            }
        }  
        else{
            echo "<script> alert('Product not found'); </script>";
        }
           
        //sleep(7);
        //header("Location: ./adminHome.php");  // redirect admin to homepage
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product</title>

    <script type="text/javascript">
        window.onload = function(){
            var form = document.getElementById('delete_product');
            form.onsubmit = function(e){
                checkFields(event);
                //alert('hi');
            }
        }

        // function to check fields
        function checkFields(event){
            var p_id = document.getElementById('p_id');
            
            if(p_id.value.length == 0){  // if product id is missing
                alert('Please enter product ID');
                event.preventDefault(); 
            }
        }
    </script>
</head>
<body>
    <form id="delete_product" action="deleteProduct.php" method="POST" enctype="multipart/form-data" style="text-align: center";>
            <h1>Delete product</h1>

            <div style="margin: 10px">
                <input type="text" id="p_id" name="p_id" placeholder="Product ID"><br>
            </div>

            <div style="text-align: center;">
                <input class="buttons" type="submit" value="Delete product">
            </div>

    </form>  

    <div style="text-align: center; font-size: 20px">
        <p> <a href="./adminHome.php">Back to home</a> </p>
    </div>    
</body>
</html>