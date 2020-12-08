<?php
    class Member {
        protected $conn;
        private $table = 'member';

        //Member properties
        public $Client_ID;
        public $Member_ID;

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
            M.Client_ID,
            M.Member_ID
              FROM " . $this->table . " as M
             WHERE
             M.Member_ID= " . $this->Member_ID;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        //Function to add
        public function add(){

            //Clean data
            $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));
            $this->Member_ID = htmlspecialchars(strip_tags($this->Member_ID));

            //Create query
            $query = "INSERT INTO " . $this->table . " (
                Client_ID,
                Member_ID) 
                VALUES ('" . $this->Client_ID . "', '" 
                . $this->Member_ID . "')";
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;

        }

        //Function to delete staff
        public function delete(){
            $this->Member_ID = htmlspecialchars(strip_tags($this->Member_ID));

            $query =  "DELETE FROM member WHERE member.`Member_ID` = '" . $this->Member_ID . "'";

            $stmt = $this->conn->prepare($query);

            //execute query
            if($stmt->execute()){
                return True;
            }

            printf("Error: %s.\n", $stmt->error);

            return False;
        }

        
        
    }