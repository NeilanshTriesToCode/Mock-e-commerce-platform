<?php
    // phpclass to connect to database
    class Database {
        // fields required to connect to the database
        private $hostName;
        private $db_name;
        private $user;
        private $pass;

        // constructor
        function __construct($hostName, $db_name, $user, $pass){
            $this->hostName = $hostName;
            $this->db_name = $db_name;
            $this->user = $user;
            $this->pass = $pass;
        } 

        // function to connect to database
        public function connect_to_db(){
            // connecting to database
            try{
                $connString = "mysql:host=".$this->hostName.";dbname=".$this->db_name; // string to connect
                $pdo = new PDO($connString, $this->user, $this->pass);
                return $pdo;          // return pdo object
            }catch(PDOException $e){
                echo(e->getMessage());
                return null;
            }
        }
      }




?>
