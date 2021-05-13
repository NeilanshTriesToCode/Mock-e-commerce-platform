<?php
    // php class for order
    class Order {
       
        public $order_id;
        public $p_id;
        public $p_name;
        public $cust_id;
        public $price;
        public $order_date;
        public $pdo;

        // function to create order
        public function createOrder($p_id, $cust_id, $p_name, $price, $pdo){
            $order_date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO orders(product_id, cust_id, product_name, price, order_date) 
                    VALUES(?, ?, ?, ?, ?)";
            $order_info = array($p_id, $cust_id, $p_name, $price, $order_date);
            $statement = $pdo->prepare($sql);
            $statement->execute($order_info);

            if($statement->rowCount() < 1){
                return 0;   // in case SQL crashes
            }

            return 1; // order created
        }

        // function to get user's orders
        public function getUserOrders($cust_id, $pdo){
            $sql = "SELECT * FROM orders
                    WHERE cust_id = ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $cust_id);
            $statement->execute();

            if($statement->rowCount() < 1){   // if order doesn't exist
                return -1;
            }

            return $statement;

        }

        // function to retrieve all orders
        public function getAllOrders($pdo){
            $sql = "SELECT * FROM orders";
            $statement = $pdo->prepare($sql);
            $statement->execute();

            if($statement->rowCount() < 1){     // if order doesn't exist
                return -1;
            }

            return $statement;
        }

    }



    








?>