<?php
    class Admin {
        protected $conn;
        private $table = 'admin';

        //Admin properties
        public $Admin_ID;
        public $First_name;
        public $Last_name;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //(GET) View 
        public function view() {
            //Create query
            $query = 'SELECT *
              FROM ' . $this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        //Function to select 
        public function select(){
            //Create query
            $query = "SELECT 
            A.Admin_ID,
            A.First_name,
            A.Last_name
              FROM " . $this->table . " as A
             WHERE
             A.Admin_ID= " . $this->Admin_ID;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        //Function to add
        public function add(){

            //Clean data
            $this->Admin_ID = htmlspecialchars(strip_tags($this->Admin_ID));
            $this->First_name = htmlspecialchars(strip_tags($this->First_name));
            $this->Last_name = htmlspecialchars(strip_tags($this->Last_name));

            //Create query
            $query = "INSERT INTO " . $this->table . " (
                Admin_ID,
                First_name,
                Last_name) 
                VALUES ('" . $this->Admin_ID . "', '" 
                . $this->First_name."', '" 
                . $this->Last_name . "')";
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;

        }

        //Function to delete admin
        public function delete(){
            $this->Admin_ID = htmlspecialchars(strip_tags($this->Admin_ID));

            $query =  "DELETE FROM admin WHERE admin.`Admin_ID` = '" . $this->Admin_ID . "'";

            $stmt = $this->conn->prepare($query);

            //execute query
            if($stmt->execute()){
                return True;
            }

            printf("Error: %s.\n", $stmt->error);

            return False;
        }

    }