<?php
    class Staff {
        protected $conn;
        private $table = 'staff';

        //Staff properties
        public $Staff_ID;
        public $FirstName;
        public $LastName;
        public $JobTitle;

        //request table properties
        public $Admin_ID;
        //public $Staff_ID;
        public $Request_ID;
        public $description;
        public $request_time;

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
            S.Staff_ID,
            S.FirstName,
            S.LastName,
            S.JobTitle
              FROM " . $this->table . " as S
             WHERE
             S.Staff_ID= " . $this->Staff_ID;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        //Function to add
        public function add(){

            //Clean data
            $this->Staff_ID = htmlspecialchars(strip_tags($this->Staff_ID));
            $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
            $this->LastName = htmlspecialchars(strip_tags($this->LastName));
            $this->JobTitle = htmlspecialchars(strip_tags($this->JobTitle));

            //Create query
            $query = "INSERT INTO " . $this->table . " (
                Staff_ID,
                FirstName,
                LastName,
                JobTitle) 
                VALUES ('" . $this->Staff_ID . "', '" 
                . $this->FirstName."', '" 
                . $this->LastName."', '" 
                . $this->JobTitle . "')";
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;

        }

        //Function to delete staff
        public function delete(){
            $this->Staff_ID = htmlspecialchars(strip_tags($this->Staff_ID));

            $query =  "DELETE FROM staff WHERE staff.`Staff_ID` = '" . $this->Staff_ID . "'";

            $stmt = $this->conn->prepare($query);

            //execute query
            if($stmt->execute()){
                return True;
            }

            printf("Error: %s.\n", $stmt->error);

            return False;
        }

        //staff to make a request
        public function make_request(){
            //Create query
            $query = 'SELECT *
            FROM ask_approval_for_removal';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();

            return $stmt;

        }

        
    }