<?php
    // php file to display products
    session_start();
    include('../header.php');
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        header('Location: adminHome.php');  // redirect to adminHome which prints error message
    }  
    else if($_GET['filterBy'] && ($_SESSION['userType'] == 1)){
        // include necessary files
        include "../classes/Database.php";  // user-defined class to connect to database
        include "../classes/Product.php";

        // getting fields
        $filter = $_GET['filterBy'];    // either ID, name, or category

        // connecting to database
        $hostName = "localhost";
        $db_name = "interview_buzztro";  // name of the database consisting relevant tables
        $user = "webuser";
        $pass = "P@ssw0rd";

        $db = new Database($hostName, $db_name, $user, $pass);
        $pdo = $db->connect_to_db();

        // create product object
        $product = new Product();
        if($_POST['filterValue'] != ''){
            $searchFor = $_POST['filterValue'];   // search for

            if($filter == 'p_id'){
                $statement =  $product->searchById($searchFor, $pdo);
            }
            else if($filter == 'name'){
                $statement =  $product->searchByName($searchFor, $pdo);
            }
            else{
                $statement =  $product->searchByCategory($searchFor, $pdo);
            }
        }    
        else{     // return all products if no value is given
            $searchFor = 'All';
            $statement =  $product->getAllProducts($pdo);
        }

        if(!$statement){
            echo "<h2> No products found</h2>";
        }
        else{  // if product(s) exists
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
                    <tbody>";    
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['p_name']."</td>
                        <td>".$row['p_description']."</td>
                        <td>".$row['category']."</td>
                        <td>$".$row['price']."00</td>
                        <td>".$row['stock']."</td>
                        <td> <img src = '../product_images/".$row['img_1']."'\" width = \"170px\" height = \"170px\"/> </td>
                        <td> <img src = '../product_images/".$row['img_2']."'\" width = \"170px\" height = \"170px\"/> </td>
                    </tr>";
            }    
            echo "</tbody>
                </table>"; 
                 
        }
    }
?>
