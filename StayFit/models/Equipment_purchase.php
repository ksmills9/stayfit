<?php
    class Equipment_purchase {
        private $conn;
        private $table = 'Purchase';

        //Equipment purchase properties
        public $Purchase_ID;
        public $Time;
        public $Date;
        public $Quantity;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //(GET) View purchasable equipment
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
