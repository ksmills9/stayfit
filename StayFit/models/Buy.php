<?php
    class purchase {
        protected $conn;

        private $table = 'purchase';

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

    }

    class buy extends purchase{
        private $table = 'buy';

        //Equipment booking properties
        public $Equipment_ID;
        public $Client_ID;



        public function make() {
            //Clean data
            $this->Equipment_ID = htmlspecialchars(strip_tags($this->Equipment_ID));
            $this->Client_ID = htmlspecialchars(strip_tags($this->Client_ID));
            $this->Purchase_ID = htmlspecialchars(strip_tags($this->Purchase_ID));
            $this->Time = htmlspecialchars(strip_tags($this->Time));
            $this->Date = htmlspecialchars(strip_tags($this->Date));
            $this->Quantity = htmlspecialchars(strip_tags($this->Quantity));


            //create queries
            //query to adds to the booking table
            $query1 = "INSERT INTO purchase (
                Purchase_ID,
                Time,
                Date,
                Quantity)
                VALUES ('" . $this->Purchase_ID . "', '"
                . $this->Time ."', '"
                . $this->Date . "', '"
                . $this->Quantity . "')";

            //query that adds to the equipment booking table
            $query2 = "INSERT INTO " . $this->table . " (

                Equipment_ID,
                Client_ID,
                Purchase_ID)
                VALUES ('" . $this->Equipment_ID . "', '"
                . $this->Client_ID ."', '"
                . $this->Purchase_ID . "')";

            //create quantity to be updated in purchasable_equipment
            $QBoughtToDecrease = intval($this->Quantity);

            //query to update the rentable equipment
            $query3 = "UPDATE purchasable_equipment
            SET In_Stock = In_Stock-" . $QBoughtToDecrease . "
            WHERE purchasable_equipment.Equipment_ID = '" . $this->Equipment_ID . "'";

            $stmt1 = $this->conn->prepare($query1);

            $stmt2 = $this->conn->prepare($query2);

            $stmt3 = $this->conn->prepare($query3);

            $stmt4;

            //execute queries
            if($stmt1->execute()){
                if($stmt2->execute()){
                    if($stmt3->execute()){


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

?>
