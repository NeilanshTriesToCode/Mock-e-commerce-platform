<?php
    // php file to update product
    session_start();
    include('../header.php');
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        header('Location: adminHome.php');    // direct to adminHome which prints error message
    } 
    else if(!empty($_POST) && ($_SESSION['userType'] == 1)){
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";     // user-defined class to manipulate products table
  
        // for now, only product properties such as price and stock are updatable
        // the admin may leave the stock field empty if they only want to update the price and vice-versa
        // the admin would fill in both the fields if they want to update both, the price and stock
        
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

        if(!isset($_POST['stock'])){   // if only price is to be updated
            $price = $_POST['price'];
            $flag =  $product->updateProductPrice($p_id, $price, $pdo);

            if($flag == 1){
                echo "<script> alert('price updated'); </script>";
            }
            else{
                echo "<script> alert('product not found'); </script>";
            }
        }  
        else if(!isset($_POST['price'])){  // if only price is to be updated
            $stock = $_POST['stock'];
            $flag =  $product->updateProductStock($p_id, $stock, $pdo);

            if($flag == 1){
                echo "<script> alert('stock updated'); </script>";
            }
            else{
                echo "<script> alert('product not found'); </script>";
            }
        }   
        else{
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $flag_1 = $product->updateProductPrice($p_id, $price, $pdo);
            $flag_2 = $product->updateProductStock($p_id, $stock, $pdo);

            if($flag_1 == 1 && $flag_2 == 1){
                echo "<script> alert('price and stock updated'); </script>";
            }
            else{
                echo "<script> alert('product not found'); </script>";
            }
        }
        //sleep(7);
        //header("Location: ./adminHome.php");  
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
            var form = document.getElementById('update_product');
            form.onsubmit = function(e){
                checkFields(event);
                //alert('hi');
            }
        }

        // function to check fields
        function checkFields(event){
            var p_id = document.getElementById('p_id');
            var product_price = document.getElementById('price');
            var product_stock = document.getElementById('stock');
            
            if(p_id.value.length == 0){  // if product id is missing
                alert('Please enter product ID');
                event.preventDefault(); 
            }

            // both product_price and product_stock can't be empty
            if(product_price.value.length == 0 && product_stock.value == 0){  // if both are empty
                alert('Both product price and stock can\'t be empty');
                event.preventDefault();
            }
           
        }
    </script>
</head>
<body>
    <div style="font-size: 20px">
        <button onclick='document.location="adminHome.php"'>Back</button>
    </div> 
      
    <form id="update_product" action="updateProduct.php" method="POST" enctype="multipart/form-data" style="text-align: center";>
            <h1>Update product</h1>

            <div style="margin: 10px">
                <input type="text" id="p_id" name="p_id" placeholder="Product ID"><br>
            </div>

            <div style="margin: 10px">
                <input type="text" id="price" name="price" placeholder="Product price"><br>
            </div>

            <div style="margin: 10px">
                <input type="text" id="stock" name="stock" placeholder="Product stock"><br>
            </div>

            <div style="text-align: center;">
                <input class="buttons" type="submit" value="Update product">
            </div>
    </form>  
</body>
</html>