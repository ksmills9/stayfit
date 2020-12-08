<?php
    class bookablelocation {
        private $conn;
        private $table = 'bookablelocation';

        //Equipment booking properties
        public $Space_ID;
        public $Space_name;
        public $Location;
        public $Capacity;
        public $Open_time;
        public $Close_time;
        public $Price;


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
              pu.Space_ID,
              pu.Space_name,
              pu.Location,
              pu.Capacity,
              pu.Open_time,
              pu.Close_time,
              pu.Price

          FROM
          ' . $this->table. ' pu
          WHERE
              pu.Space_ID = ?
          LIMIT 0,1';

          //Prepare statement
          $stmt = $this->conn->prepare($query);

          //Bind ID
          $stmt->bindParam(1, $this->Space_ID);

          //Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          //Set properties
          $this->Space_name = $row['Space_name'];
          $this->Location = $row['Location'];
          $this->Capacity = $row['Capacity'];
          $this->Open_time = $row['Open_time'];
          $this->Close_time = $row['Close_time'];
          $this->Price = $row['Price'];

          return $stmt;

      }


      public function edit() {
                  //Create query
                  $query = "UPDATE " . $this->table . "
                  SET
                  Space_name='" . $this->Space_name .
                  "', Location='" . $this->Location .
                  "', Capacity='" . $this->Capacity .
                  "', Open_time='" . $this->Open_time .
                  "', Close_time='" . $this->Close_time .
                  "', Price='" . $this->Price .
                  "' WHERE " . $this->table .".Space_ID=
                  '" . $this->Space_ID . "'";

                  //Prepare statement
                  $stmt = $this->conn->prepare($query);

                  //Format data
                  $this->Space_name = htmlspecialchars(strip_tags($this->Space_name));
                  $this->Location = htmlspecialchars(strip_tags($this->Location));
                  $this->Capacity = htmlspecialchars(strip_tags($this->Capacity));
                  $this->Open_time = htmlspecialchars(strip_tags($this->Open_time));
                  $this->Close_time = htmlspecialchars(strip_tags($this->Close_time));
                  $this->Price = htmlspecialchars(strip_tags($this->Price));
                  $this->Space_ID = htmlspecialchars(strip_tags($this->Space_ID));



                  //Bind data
                  $stmt->bindParam(':Space_name', $this->Space_name);
                  $stmt->bindParam(':Location', $this->Location);
                  $stmt->bindParam(':Capacity', $this->Capacity);
                  $stmt->bindParam(':Open_time', $this->Open_time);
                  $stmt->bindParam(':Close_time', $this->Close_time);
                  $stmt->bindParam(':Price', $this->Price);
                  $stmt->bindParam(':Space_ID', $this->Space_ID);



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
          $query = 'DELETE FROM ' . $this->table . ' WHERE Space_ID = :Space_ID';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->Equipment_ID = htmlspecialchars(strip_tags($this->Space_ID));

          // Bind data
          $stmt->bindParam(':Space_ID', $this->Space_ID);

          // Execute query
          if($stmt->execute()) {
          return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
      }
    }
