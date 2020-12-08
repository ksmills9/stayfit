<?php
    class Rentable_equipment {
        private $conn;
        private $table = 'rentable_equipment';

        //Rentable_equipment properties
        public $Equipment_ID;
        public $Name;
        public $Quantity;
        public $Price;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //(GET) View Rentable equipments
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
                re.Equipment_ID,
                re.Name,
                re.Quantity,
                re.Price 
            FROM 
            ' . $this->table . ' re
            WHERE
                re.Equipment_ID = ?
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
            $this->Price = $row['Quantity'];
            $this->In_Stock = $row['Price'];
            
            return $stmt;

        }

        //Add rentable equipment
        public function add() {
            //Create query
            $query =  'INSERT INTO ' . $this->table . ' SET Equipment_ID = :Equipment_ID, Name = :Name, Quantity = :Quantity, Price = :Price';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Format data
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
            $this->Price = htmlspecialchars(strip_tags($this->Price));

            //Bind data
            $stmt->bindParam(':Equipment_ID', $this->Equipment_ID);
            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':Quantity', $this->Quantity);
            $stmt->bindParam(':Price', $this->Price);

            //Execute
           if($stmt->execute()) {
               return true;
           }
            
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Update rentable equipment
        public function update() {
            //Create query
            $query = "UPDATE " . $this->table . "
            SET 
            Name='" . $this->Name . 
            "', Quantity='" . $this->Quantity . 
            "', Price='" . $this->Price .
            "' WHERE " . $this->table .".Equipment_ID= 
            '" . $this->Equipment_ID . "'";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Format data
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
            $this->Price = htmlspecialchars(strip_tags($this->Price));
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));

            //Bind data
            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':Quantity', $this->Quantity);
            $stmt->bindParam(':Price', $this->Price);
            $stmt->bindParam(':Equipment_ID', $this->Equipment_ID);

            //Execute
           if($stmt->execute()) {
               return true;
           }
            
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // Delete rentable equipment
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
    }