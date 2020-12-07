<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Purchasable_equipment.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $pu_equipment = new Purchasable_equipment($db);

    $result = $pu_equipment->view();
    $num = $result->rowCount();

    //Check for bookings
    if($num > 0){
        $pu_equipments_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $pu_equipments_arr[] = array(
                'Equipment_ID ' => $row['Equipment_ID'],
                'Name' => $row['Name'],
                'Price' => $row['Price'],
                'In_Stock' => $row['In_Stock']
            );
        }
        //Turn to JSON & output
        echo json_encode($pu_equipments_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }

