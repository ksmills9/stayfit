<?php
    class Equipment_booking {
        private $conn;
        private $table = 'equipment_booking';

        //Equipment booking properties
        public $Client_ID;
        public $Booking_ID;
        public $Equipment_ID;
        public $Quantity_booked;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //(GET) View Equipment bookings
        public function view() {
            //Create query
            $query = 'SELECT * FROM ' . $this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

    }