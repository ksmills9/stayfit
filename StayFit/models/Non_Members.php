<?php
    class Non_Members {
        private $conn;
        private $table = 'non_member';
        //private $table2 = 'client';


        //Equipment booking properties
        public $Client_ID;
        public $last_visited_date;
        public $last_entry_time;
        public $last_exit_time;

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

        //Select Bookable location
        //Select a single row
      public function select() {
          //Create query
          $query = 'SELECT
              pu.Client_ID,
              pu.last_visited_date,
              pu.last_entry_time,
              pu.last_exit_time

          FROM
          ' . $this->table. ' pu
          WHERE
              pu.Client_ID = ?
          LIMIT 0,1';

          //Prepare statement
          $stmt = $this->conn->prepare($query);

          //Bind ID
          $stmt->bindParam(1, $this->Client_ID);

          //Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          //Set properties
          $this->last_visited_date = $row['last_visited_date'];
          $this->last_entry_time = $row['last_entry_time'];
          $this->last_exit_time = $row['last_exit_time'];


          return $stmt;

      }
      public function edit() {
                  //Create query
                  $query = "UPDATE " . $this->table . "
                  SET
                  last_visited_date='" . $this->last_visited_date .
                  "', last_entry_time='" . $this->last_entry_time .
                  "', last_exit_time='" . $this->last_exit_time .
                  "' WHERE " . $this->table .".Client_ID=
                  '" . $this->Client_ID . "'";

                  //Prepare statement
                  $stmt = $this->conn->prepare($query);

                  //Format data
                  $this->last_visited_date = htmlspecialchars(strip_tags($this->last_visited_date));
                  $this->last_entry_time = htmlspecialchars(strip_tags($this->last_entry_time));
                  $this->last_exit_time = htmlspecialchars(strip_tags($this->last_exit_time));
                  $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));

                  //Bind data
                  $stmt->bindParam(':last_visited_date', $this->last_visited_date);
                  $stmt->bindParam(':last_entry_time', $this->last_entry_time);
                  $stmt->bindParam(':last_exit_time', $this->last_exit_time);
                  $stmt->bindParam(':Client_ID', $this->Client_ID);

                  //Execute
                 if($stmt->execute()) {
                     return true;
                 }

                  printf("Error: %s.\n", $stmt->error);
                  return false;
              }

        // add Non-Members
        public function add() {
          //Create query
          $query =  "INSERT INTO non_member (
                Client_ID,
                last_visited_date,
                last_entry_time,
                last_exit_time)
                VALUES ('" . $this->Client_ID . "', '"
                . $this->last_visited_date ."', '"
                . $this->last_entry_time . "', '"
                . $this->last_exit_time . "')";
          //Prepare statement
          $stmt = $this->conn->prepare($query);

          //Format data
          $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));
          $this->last_visited_date = htmlspecialchars(strip_tags($this->last_visited_date));
          $this->last_entry_time = htmlspecialchars(strip_tags($this->last_entry_time));
          $this->last_exit_time = htmlspecialchars(strip_tags($this->last_exit_time));

          //Bind data
          $stmt->bindParam(':Client_ID', $this->Client_ID);
          $stmt->bindParam(':last_visited_date', $this->last_visited_date);
          $stmt->bindParam(':last_entry_time', $this->last_entry_time);
          $stmt->bindParam(':last_exit_time', $this->last_exit_time);

          //Execute
         if($stmt->execute()) {
             return true;
         }

          printf("Error: %s.\n", $stmt->error);
          return false;
      }

        // Delete Bookable location
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE Client_ID = :Client_ID';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));

            // Bind data
            $stmt->bindParam(':Client_ID', $this->Client_ID);

            // Execute query
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
