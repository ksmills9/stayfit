<?php
    class Purchasable_equipment {
        private $conn;
        private $table = 'purchasable_equipment';

        //Purchasable_equipment properties
        public $Equipment_ID;
        public $Name;
        public $Price;
        public $In_Stock;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //(GET) View Purchasable equipments
        public function view() {
            //Create query
            $query = 'SELECT * FROM ' . $this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();

            return $stmt;
        }

        //Select a single row
        public function select() {
            //Create query
            $query = 'SELECT
                pu.Equipment_ID,
                pu.Name,
                pu.Price,
                pu.In_Stock
            FROM
            ' . $this->table . ' pu
            WHERE
                pu.Equipment_ID = ?
            LIMIT 0,1';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->Equipment_ID);

            //Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->Name = $row['Name'];
            $this->Price = $row['Price'];
            $this->In_Stock = $row['In_Stock'];

            return $stmt;

        }

        public function add() {
            //Create query
            $query =  'INSERT INTO ' . $this->table . ' SET Equipment_ID = :Equipment_ID, Name = :Name, Price = :Price, In_Stock = :In_Stock';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Format data
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->Price = htmlspecialchars(strip_tags($this->Price));
            $this->In_Stock = htmlspecialchars(strip_tags($this->In_Stock));

            //Bind data
            $stmt->bindParam(':Equipment_ID', $this->Equipment_ID);
            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':Price', $this->Price);
            $stmt->bindParam(':In_Stock', $this->In_Stock);

            //Execute
           if($stmt->execute()) {
               return true;
           }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }
/*
        public function update() {
            //Create query
            $query = 'UPDATE' .
            $this->table . '
            SET
                Name = :Name,
                Price = :Price,
                In_Stock = :In_Stock
            WHERE
                Equipment_ID = :Equipment_ID';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Format data
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->Price = htmlspecialchars(strip_tags($this->Price));
            $this->In_Stock = htmlspecialchars(strip_tags($this->In_Stock));
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));

            //Bind data
            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':Price', $this->Price);
            $stmt->bindParam(':In_Stock', $this->In_Stock);
            $stmt->bindParam(':Equipment_ID', $this->Equipment_ID);

            //Execute
           if($stmt->execute()) {
               return true;
           }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // Delete Equipment
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE Equipment_ID = :Equipment_ID';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));

            // Bind data
            $stmt->bindParam(':Equipment_ID', $this->Equipment_ID);

            // Execute query
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
        */
    }
