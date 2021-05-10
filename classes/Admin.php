<?php
    // php class to support admin functions
    class Admin {
         // fields
         public $id;
         public $username;
         public $email;
         public $password;
         public $pdo;  // object received on connecting to database 

         // function to create admin
         public function createAdmin($username, $email, $password){
              // check if admin already exists
              $admin = new Admin();
              if( $admin->adminExists($username, $email, $pdo) ){
                 return -1;    // if admin exists
             }
             // user doesn't exist
             // SQL query to create new user
             $password_hash = md5($password);
             $sql = "INSERT INTO admins(username, email, pw_hash) VALUES(?, ?, ?)";
             $statement = $pdo->prepare($sql);
             $statement->bindParam(1, $username);
             $statement->bindParam(3, $email);
             $statement->bindParam(4, $password_hash);
             $statement->execute();
 
             if($statement->rowCount() < 1){
                 return 0;   // in case SQL crashes
             }
 
             return 1; // admin account successfully created
         }

        // function to login admin
        public function loginAdmin($username, $email, $password, $pdo){
            // SQL statement to check if user exists with given email/password combination
            $password_hash = md5($password);
            $sql = "SELECT * FROM admins WHERE username = :username AND email = :email AND pw_hash = :password_hash";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password_hash', $password_hash);
            $statement->execute();

              // check if an admin exists
              if($statement->rowCount() > 0){
                return 1;   // admin exists
            }

            return 0;  // incorrect admin fields
        }

        // function to check if an admin exists
        public function adminExists($username, $email, $pdo){
            $sql = "SELECT * FROM admins WHERE username = ? AND email = ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $email);
            $statement->execute();

            // check if an admin exists
            if($statement->rowCount() > 0){
                return true;   // admin exists
            }

            return false;  /// admin doesn't exist
        }

        // function to retrieve admin info
        public function getAdminInfo($username, $email, $pdo){
            $sql = "SELECT * FROM admins WHERE username = ? AND email = ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $email);
            $statement->execute();

            // retrieve admin details
            $row = $pre_q->fetch(PDO::FETCH_ASSOC);
            $this->username = $row['username'];
            $this->email = $row['email'];

            return true;
        }

    }
?>