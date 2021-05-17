<?php
  // php file to display products
  session_start();
  include('../header.php');
  if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
      header('Location: adminHome.php');  // redirect to adminHome which prints error message
  }
  else{
    // php file to show all orders to the admin
    // include necessary files
    include "../classes/Database.php";  // user-defined class to connect to database
    include "../classes/Product.php";     // user-defined class to manipulate products table
    include "../classes/Order.php";     // user-defined class to access user functions

    // connecting to database
    $hostName = "localhost";
    $db_name = "interview_buzztro";  // name of the database consisting relevant tables
    $user = "webuser";
    $pass = "P@ssw0rd";

    $db = new Database($hostName, $db_name, $user, $pass);
    $pdo = $db->connect_to_db();

    // create order object
    $order = new Order();
    $statement = $order->getAllOrders($pdo);    // get all orders

    echo "<button onclick='document.location=\"adminHome.php\"'>Back</button>";

    if($statement == -1){
        echo "<script> alert('you have no orders'); </script>";
    }
    else{
        echo "<table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Customer ID</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Ordered on</th>
                </tr>
            </thead>";    
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['product_id']."</td>
                    <td>".$row['cust_id']."</td>
                    <td>".$row['product_name']."</td>
                    <td>".$row['price']."</td>
                    <td>".$row['order_date']."</td>                   
                 </tr>";
        }
        echo "</table>"; 
    }

 }  

?>