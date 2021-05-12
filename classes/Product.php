<?php
    // php class for products
    class Product {

        public $id;
        public $p_name;
        public $p_description;
        public $category;
        public $price;
        public $stock;
        public $img_1;
        public $img_2;

        // function to add product to the database
        public function addProduct($p_name, $p_description, $category, $price, $stock, $img1, $img2, $pdo){
            // check if admin already exists
            $product = new Product();
            if( $product->productExists($id, $p_name, $pdo) ){
               return -1;    // if admin exists
            }

            // SQL statement to insert into products table
            $sql = "INSERT INTO products(p_name, p_description, category, price, stock, img_1, img_2) 
                    VALUES(?, ?, ?, ?, ?, ?, ?)";
            $statement = $pdo->prepare($sql);
            $product_info = array($p_name, $p_description, $category, $price, $stock, $img1, $img2);
            $statement->execute($product_info);

            if($statement->rowCount() < 1){
                return 0;   // in case SQL crashes
            }

            return 1; // product added successfully
        }

        // function to display a product with given id and name
        public function getProduct($id, $p_name, $pdo){

            $sql = "SELECT * FROM products WHERE id = ? AND p_name LIKE ?";
            $statement = $pdo->execute($sql);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $p_name);
            $statement->execute();

            // retrieve product info
            $row = $pre_q->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->p_name = $row['p_name'];
            $this->p_description = $row['p_description'];
            $this->category = $row['category'];
            $this->price = $row['price'];
            $this->stock = $row['stock'];
            $this->img_1 = $row['img_1'];
            $this->img_2 = $row['img_2'];

            return true;
        }

        // function to display all products
        public function getAllProducts(){
            $allProducts = [[]];
            $sql = "SELECT * FROM products";
            $statement = $pdo->execute($sql);
            $statement->execute();

            // retrieve all products
            $row = $pre_q->fetch(PDO::FETCH_ASSOC);
            // code further
            

        }

        // function to check if a product exists
        public function productExists($id, $p_name, $pdo){
            $sql = "SELECT * FROM products WHERE id = ? AND p_name LIKE ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $p_name);
            $statement->execute();

            // check if a product exists
            if($statement->rowCount() > 0){
                return true;   // product exists
            }

            return false;  // product doesn't exist
        }


    }



?>