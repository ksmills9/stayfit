<?php
    class Payment {
        protected $conn;

        private $table = 'booking';

        //Payment Properties
        public $Payment_ID;
        public $Booking_ID;
        public $Amount_paid;
        public $Time;
        public $Date;
        public $Client_ID;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        public function view() {
            $query = "SELCT * FROM " . $this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        public function select(){
            $query = "SELECT * FROM " . $this->table . " WHERE " .$this->table. ".Payment_ID = '" . $this->Payment_ID . "'";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        public function make(){
            $this->Payment_ID = htmlspecialchars(strip_tags($this->Payment_ID));
            $this->Booking_ID = htmlspecialchars(strip_tags($this->Booking_ID));
            $this->Amount_paid = htmlspecialchars(strip_tags($this->Amount_paid));
            $this->Time = htmlspecialchars(strip_tags($this->Time));
            $this->Date = htmlspecialchars(strip_tags($this->Date));
            $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));

            $query = "INSERT INTO " . $this->table . "(Payment_ID, Booking_ID, Amount_paid, Time, Date, Client_ID) VALUES ('" . $this->Payment_ID . "', '". $this->Booking_ID ."', '". $this->Amount_paid ."', '". $this->Time ."', '". $this->Date ."', '". $this->Client_ID ."')";

            $stmt = $this->conn->prepare($query);

             //execute query
             if($stmt->execute()){
                return True;
            }

            printf("Error: %s.\n", $stmt->error);

            return False;
        }

        public function delete(){
            $query = "DELETE FROM " . $this->table . " WHERE " .$this->table. ".Payment_ID = '" . $this->Payment_ID . "'";

             //Prepare statement
             $stmt = $this->conn->prepare($query);

             //execute query
            if($stmt->execute()){
                return True;
            }

            printf("Error: %s.\n", $stmt->error);

            return False;
        }
    }
?>