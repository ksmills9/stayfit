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
            $query = 'SELECT 
            E.Booking_ID,
            E.Client_ID,
            B.Date,
            B.Start_time,
            B.End_time,
            E.Equipment_ID,
            E.Quantity_booked
              FROM ' . $this->table . ' as E
            INNER JOIN booking as B ON E.Booking_ID=B.Booking_ID';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        public function select(){
            //Create query
            $query = "SELECT 
            E.Booking_ID,
            E.Client_ID,
            B.Date,
            B.Start_time,
            B.End_time,
            E.Equipment_ID,
            E.Quantity_booked
              FROM " . $this->table . " as E
            INNER JOIN booking as B ON E.Booking_ID=B.Booking_ID
             WHERE
             E.Booking_ID= '" . $this->Booking_ID . "'";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();
            
            return $stmt;
        }

        public function create() {
            //create query
            $query = 'INSERT INTO' . $this->table . '
            (Client_ID,
            Booking_ID,
            Equipment_ID,
            Quantity_booked)
            VALUES
                ('.$this->Booking_ID.', 
                :Client_ID, 
                :Date, 
                :Start_time, 
                :End_time, 
                :Equipment_ID, 
                :Quantity_booked)';
            
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));
            $this->Booking_ID = htmlspecialchars(strip_tags($this->Booking_ID));
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));
            $this->Quantity_booked = htmlspecialchars(strip_tags($this->Quantity_booked));

        }

    }