<?php
    

    // php class to support user functions such as login and signup
    class User {
        // fields
        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $password;
        public $pdo;  // object received on connecting to database 

        // constructor
       /* function __construct($firstName, $lastName, $email, $password, $pdo){
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->pdo = $pdo;
        } */

        // function to login
        public function createUser($firstName, $lastName, $email, $password, $pdo){
             // check if user already exists
             $user = new User();
             if( $user->userExists($email, $pdo) ){
                return -1;    // if user exists
            }
            // user doesn't exist
            // SQL query to create new user
            $password_hash = md5($password);
            $sql = "INSERT INTO Users(firstName, lastName, email, pw_hash) VALUES(?, ?, ?, ?)";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $firstName);
            $statement->bindParam(2, $lastName);
            $statement->bindParam(3, $email);
            $statement->bindParam(4, $password_hash);
            $statement->execute();

            if($statement->rowCount() < 1){
                return 0;   // in case SQL crashes
            }

            return 1; // account successfully created
        }

        // function to login
        public function loginUser($email, $password, $pdo){
            // SQL statement to check if user exists with given email/password combination
            $password_hash = md5($password);
            $sql = "SELECT * FROM Users WHERE email = :email AND pw_hash = :password_hash";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password_hash', $password_hash);
            $statement->execute();

              // check if a user exists
              if($statement->rowCount() > 0){
                return 1;   // user exists
            }

            return 0;  // incorrect user fields
        }

        // function to check if a user exists
        public function userExists($email, $pdo){
            $sql = "SELECT * FROM Users WHERE email = ?";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $email);
            $statement->execute();

            // check if a user exists
            if($statement->rowCount() > 0){
                return true;   // user exists
            }

            return false;  /// user doesn't exist
        }

        // function to retrieve user info
        public function getUserInfo($email, $pdo){
            $sql = "SELECT * FROM users WHERE email = ?";  // will return one row
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $email);
            $statement->execute();

            // retrieve user details
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->firstName = $row['firstName'];            
            $this->lastName = $row['lastName'];
            $this->email = $row['email'];

            return true;
        }
    }
?>