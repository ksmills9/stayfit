<?php
    class Booking {
        protected $conn;

        private $table = 'booking';

        public $Booking_ID;
        public $Client_ID;
        public $Date;
        public $Start_time;
        public $End_time;

        public $Member_ID;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

    }

    class Equipment_booking extends Booking{
        private $table = 'equipment_booking';

        //Equipment booking properties
        // public $Client_ID;
        // public $Booking_ID;
        public $Equipment_ID;
        public $Quantity_booked;

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

        public function make() {
            //Clean data
            $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));
            $this->Booking_ID = htmlspecialchars(strip_tags($this->Booking_ID));
            $this->Date = htmlspecialchars(strip_tags($this->Date));
            $this->Start_time = htmlspecialchars(strip_tags($this->Start_time));
            $this->End_time = htmlspecialchars(strip_tags($this->End_time));
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));
            $this->Quantity_booked = htmlspecialchars(strip_tags($this->Quantity_booked));

            //create queries
            //query to adds to the booking table
            $query1 = "INSERT INTO booking (
                Booking_ID, 
                Client_ID, 
                Date, 
                Start_time, 
                End_time) 
                VALUES ('" . $this->Booking_ID . "', '" 
                . $this->Client_ID ."', '" 
                . $this->Date . "', '" 
                . $this->Start_time . "', '" 
                . $this->End_time . "')";
            
            //query that adds to the equipment booking table
            $query2 = "INSERT INTO " . $this->table . " (
                Client_ID, 
                Booking_ID, 
                Equipment_ID, 
                Quantity_booked) 
                VALUES ('" . $this->Client_ID . "', '" 
                . $this->Booking_ID ."', '" 
                . $this->Equipment_ID . "', '" 
                . $this->Quantity_booked . "')";
            
            //create quantity to be updated in rentable equipment
            $QBookedToDecrease = intval($this->Quantity_booked);
            
            //query to update the rentable equipment
            $query3 = "UPDATE rentable_equipment 
            SET Quantity = Quantity-" . $QBookedToDecrease . " 
            WHERE rentable_equipment.Equipment_ID = '" . $this->Equipment_ID . "'";
            
            $stmt1 = $this->conn->prepare($query1);

            $stmt2 = $this->conn->prepare($query2);

            $stmt3 = $this->conn->prepare($query3);

            $stmt4;
            
            //execute queries
            if($stmt1->execute()){
                if($stmt2->execute()){
                    if($stmt3->execute()){
                        //checks if the client is a member or not
                        if($this->checkMember()){
                            //query to insert into made past bookings
                            $query4 = "INSERT INTO made_past_booking (Member_ID, Booking_ID) VALUES ('" . $this->Member_ID . "', '" . $this->Booking_ID . "')";
                            //prepare query
                            $stmt4 = $this->conn->prepare($query4);
                            //insert into past bookings table
                            $stmt4->execute();
                        }
                        return true;
                    }  
                }
            }

            //Print error if something goes wrong
            if($stmt1 != NULL){
                printf("Error: %s.\n", $stmt1->error);
            }
            elseif($stmt2 != NULL){
                printf("Error: %s.\n", $stmt2->error);
            }
            elseif($stmt3 !=NULL){
                printf("Error: %s.\n", $stmt3->error);
            } else{
                printf("Error: %s.\n", $stmt4->error);
            }
            return false;

        }

        //function that checks if the client is a member and adds their member_ID to the model.
        public function checkMember(){
            $query = "SELECT *
            FROM member
            WHERE member.Client_ID= '" . $this->Client_ID . "'";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            if($stmt->rowCount()>0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $this->Member_ID = $row['Member_ID'];
                }
                return True;
            } else{
                return False;
                printf("Error: %s.\n", $stmt->error);
            }
        }

       //Function to Edit Equipment Bookings
       public function edit(){
           //Clean data
           $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));
           $this->Booking_ID = htmlspecialchars(strip_tags($this->Booking_ID));
           $this->Date = htmlspecialchars(strip_tags($this->Date));
           $this->Start_time = htmlspecialchars(strip_tags($this->Start_time));
           $this->End_time = htmlspecialchars(strip_tags($this->End_time));
           $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));
           $this->Quantity_booked = htmlspecialchars(strip_tags($this->Quantity_booked));

           //update queries
           //query to updates the booking table
           $query1 = "UPDATE booking
               SET Date='" . $this->Date . 
               "', Start_time='" . $this->Start_time . 
               "', End_time='" . $this->End_time . 
               "' WHERE booking.Booking_ID= 
               '" . $this->Booking_ID . "'";
           
           //query that updates the equipment booking table
           $query2 = "UPDATE " . $this->table . "
                SET 
                Equipment_ID='" . $this->Equipment_ID . 
                "', Quantity_booked='" . $this->Quantity_booked . 
                "' WHERE " . $this->table .".Booking_ID= 
                '" . $this->Booking_ID . "'";
            
            //changes to booking table
            
            //create quantity to be updated in rentable equipment
            $QBookedToChange = intval($this->Quantity_booked);
            
            //Constraint to Change
            //Equipment_booking
            //ALTER TABLE `equipment_booking` DROP FOREIGN KEY `eqBookingRef`; ALTER TABLE `equipment_booking` ADD CONSTRAINT `eqBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking`(`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
            //made_past_booking
            //ALTER TABLE `made_past_booking` DROP FOREIGN KEY `pastBookingRef`; ALTER TABLE `made_past_booking` ADD CONSTRAINT `pastBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking`(`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
            //gym_booking
            //ALTER TABLE `gym_booking` DROP FOREIGN KEY `gymBookingRef`; ALTER TABLE `gym_booking` ADD CONSTRAINT `gymBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking`(`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
            //space_booking
            //ALTER TABLE `space_booking` DROP FOREIGN KEY `spaceBookingRef`; ALTER TABLE `space_booking` ADD CONSTRAINT `spaceBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking`(`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

            //query to update the rentable equipment
            $query3 = "UPDATE rentable_equipment 
            SET Quantity = Quantity-" . $QBookedToChange . " 
            WHERE rentable_equipment.Equipment_ID = '" . $this->Equipment_ID . "'";
            
            $stmt1 = $this->conn->prepare($query1);

            $stmt2 = $this->conn->prepare($query2);

            $stmt3 = $this->conn->prepare($query3);

            if($stmt1->execute()){
                if($stmt2->execute()){
                    if($stmt3->execute()){
                        //Need to add a query to return the number of the rentable equipment borrowed, before it decrements another equipment again
                        return True;
                    }
                }
           }

           //Print error if something goes wrong
           if($stmt1 != NULL){
                printf("Error: %s.\n", $stmt1->error);
            }
            elseif($stmt2 != NULL){
                printf("Error: %s.\n", $stmt2->error);
            }
            else{
                printf("Error: %s.\n", $stmt3->error);
            }
            return false;
        }

        public function delete(){
            $this->Booking_ID = htmlspecialchars(strip_tags($this->Booking_ID));

            $query =  "DELETE FROM booking WHERE booking.`Booking_ID` = '" . $this->Booking_ID . "'";

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