<?php
    class Equipment_purchase {
        private $conn;
        private $table1 = 'Buy';
        private $table2 = 'Purchase';

        //Equipment purchase properties
        //purchase, bookable location, client
        public $Equipment_ID;
        public $Client_ID;
        public $Purchase_ID;
        public $Time;
        public $Date;
        public $Quantity;



        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //(GET) View purchasable equipment
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


    }
