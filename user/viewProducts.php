<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>

    <script>
        window.onload = function(){
            var search_form = document.getElementById('search_product');
            var searchBy = document.getElementById('searchBy');
            var filter = document.getElementById('filter');

            searchBy.onchange = function(){
                if(searchBy.value == 'name'){
                    filter.placeholder = 'Search by Name';
                    search_form.action = 'viewProducts.php?filterBy=name';
                }
                else{
                    filter.placeholder = 'Search by Category';
                    search_form.action = 'viewProducts.php?filterBy=category';
                }
            }

        }

    </script>
</head>
<body>
    <div style="margin: 10px">
        <button onclick="document.location='userHome.php'">Back</button>
    </div>
    <form id='search_product' action='viewProducts.php?filterBy=name' method="POST" enctype="multipart/form-data" style="text-align: center">

        <label>Search by:</label>
        <select id="searchBy">
          <option value="name" selected>name</option>
          <option value="category">category</option>
        </select>

        <div style="margin: 10px">
            <input type="text" id="filter" name="filterValue" placeholder="Search by Name">
            <input class="buttons" type="submit" value="Search">
        </div>

    </form>
</body>
</html>


<?php
    // directed when user successfully logs in
    session_start();   // starting session
    include('../header.php');
    if(!isset($_SESSION['email']) || !isset($_SESSION['userType'])){
        echo "Log In to see this page";
        echo "<h3> <a href = \"login.html\">Take me there</a> </h3>";
    }
    else if(isset($_GET['filterBy'])){
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";
        // display products in tabular form

        // getting fields from the form     
        $filter = $_GET['filterBy'];     // either Name or Category
    
        // connecting to the database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();

        // create product object
        $product = new Product();
        $statement = false;
        if($_POST['filterValue'] != ''){
            $searchFor = $_POST['filterValue'];   // search for

            if($filter == 'name'){
                $statement =  $product->searchByName($searchFor, $pdo);
            }
            else{
                $statement =  $product->searchByCategory($searchFor, $pdo);
            }
        }    
        else{
            $searchFor = 'All';
            $statement =  $product->getAllProducts($pdo);
        }

        if(!$statement){
            echo "<h2> No products found</h2>";
        }
        else{
            echo "<h3 style=\"font-style: italic\"> Showing results for '".$searchFor."':</h3>";
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
    }

?>