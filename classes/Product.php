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
            // check if product already exists
            $product = new Product();
            if( $product->productExists($p_name, $pdo) ){
               return -1;    // if product exists
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
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $p_name);
            $statement->execute();

            // retrieve product info
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if($statement->rowCount() > 0){   // product found
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

            return false;   // product not found         
        }

        // function to display product with given id
        public function getProductWithId($id, $pdo){

            $sql = "SELECT * FROM products WHERE id = ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->execute();

            // retrieve product info
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if($statement->rowCount() > 0){   // product found
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

            return false;   // product not found 
        }

        // function to search products by name
        public function searchByName($p_name, $pdo){
            $sql = "SELECT * FROM products WHERE p_name LIKE ? ";
            $p_name = "%$p_name%";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $p_name);
            $statement->execute();

            if($statement->rowCount() > 0){   // product found    
                return $statement;
            }

            return false;   // product not found 
        }

          // function to search products by category
          public function searchByCategory($category, $pdo){
            $sql = "SELECT * FROM products WHERE category LIKE ? ";
            $category = "%$category%";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $category);
            $statement->execute();

            if($statement->rowCount() > 0){   // product found
                return $statement;
            }

            return false;   // product not found 
        }

        // function to display all products
        public function getAllProducts($pdo){
            $allProducts = [[]];
            $sql = "SELECT * FROM products";
            $statement = $pdo->prepare($sql);
            $statement->execute();

            // retrieve all products
            //$row = $statement->fetch(PDO::FETCH_ASSOC);
            return $statement;

        }

        // function to check if a product exists
        public function productExists($p_name, $pdo){
            $sql = "SELECT * FROM products WHERE p_name LIKE ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $p_name);
            $statement->execute();

            // check if a product exists
            if($statement->rowCount() > 0){
                return true;   // product exists
            }

            return false;  // product doesn't exist
        }

        // function to check if product with given id exists
        public function productWithIdExists($id, $pdo){
             // check if product with given id exists
             $sql = "SELECT * FROM products WHERE id = ?";
             $statement = $pdo->prepare($sql);
             $statement->bindParam(1, $id);
             $statement->execute();
 
             if($statement->rowCount() < 1){
                 return false;   // product doesn't exist
             }

             return true;
        }

        // function to update product price with given id
        public function updateProductPrice($id, $price, $pdo){
            // check if product with given id exists
            $product = new Product();
            if(!$product->productWithIdExists($id, $pdo)){
              return -1;   // product doesn't exist
            }

            // update product price     
            $sql = "UPDATE products
                    SET price = '$price'
                    WHERE id = '$id'";
            $count = $pdo->exec($sql);
            
            return 1;   // product updated
        }

        // function to update product stock with given id
        public function updateProductStock($id, $stock, $pdo){
            // check if product with given id exists
            $product = new Product();
            if(!$product->productWithIdExists($id, $pdo)){
              return -1;   // product doesn't exist
            }

            // update product stock    
            $sql = "UPDATE products
                    SET stock = '$stock'
                    WHERE id = '$id'";
            $count = $pdo->exec($sql);
            
            return 1;   // product updated
        }

        // function to delete a product with given id
        public function deleteProduct($id, $pdo){

            // check if product with given id exists
            $product = new Product();
            if(!$product->productWithIdExists($id, $pdo)){
                return -1;   // product doesn't exist
            }

            // if a product exists
            $sql = "DELETE FROM products WHERE id = ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->execute();

            // validate if the product is deleted
            if(!$product->productWithIdExists($id, $pdo)){
                return 1;   // delete successful
            }
        }



    }



?>