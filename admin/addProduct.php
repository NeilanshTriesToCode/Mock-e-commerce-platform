<?php
    session_start();
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're loooking for</h2>";
    }  
    else{
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";     // user-defined class to manipulate products table

        // connecting to database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        // creating database object
        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();  // returns PDO object

        $product = new Product();
            
        }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>

    <script type="text/javascript">
        window.onload = function(){
            var form = document.getElementById('add_product');
            form.onsubmit = function(e){
                checkFields(event);
                //alert('hi');
            }
        }

        // function to check fields
        function checkFields(event){
            var p_name = document.getElementById('p_name');
            var p_description = document.getElementById('p_description');
            var category = document.getElementById('category');  
            var price = document.getElementById('price');    
            var stock = document.getElementById('stock');  
            var img_1 = document.getElementById('img_1');        
            var img_2 = document.getElementById('img_2');        
          
            // creating an array of required fields to check field validity
            var required_fields = [p_name, p_description, category, price, stock, img_1, img_2];
            for(var i = 0; i < required_fields.length; i++){
                if(required_fields[i].value.length == 0){  // if a field is empty
                    alert('One or more fields are empty');
                    event.preventDefault();               
                }        
            }
            
            // checking if the images are in the right format
            var valid_formats = ['jpg', 'jpeg', 'png', 'tiff', 'gif'];
            var images = [img_1.value]
        }
    </script>
</head>
<body>
    <form id="add_product" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="text-align: center";>
            <h1>Add product</h1>

            <div style="margin: 10px">
                <input type="text" id="p_name" name="p_name" placeholder="Product name"><br>
            </div>

            <div style="margin: 10px">
                <input type="textarea" id="p_description" name="p_description" placeholder="Description"><br>
            </div>

            <div style="margin: 10px">
                <input type="text" id="category" name="category" placeholder="Category"><br>
            </div>

            <div style="margin: 10px">
                <input type="text" id="price" name="price" placeholder="Price"><br>
            </div>

            <div style="margin: 10px">
                <input type="text" id="stock" name="stock" placeholder="Stock"><br>
            </div>

            <div style="margin: 10px">
                <input type="file" id="img_1" name="img_1" placeholder="IMG 1"><br>
            </div>

            <div style="margin: 10px">
                <input type="file" id="img_2" name="img_2" placeholder="IMG 2"><br>
            </div>

            <div style="text-align: center;">
                <input class="buttons" type="submit" value="Add product">
            </div>

        </form>     
</body>
</html>