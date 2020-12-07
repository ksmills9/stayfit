<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Rentable_equipment.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $re_equipment = new Rentable_equipment($db);

    $result = $re_equipment->view();
    $num = $result->rowCount();

    //Check for bookings
    if($num > 0){
        $re_equipments_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $re_equipments_arr[$row['Equipment_ID']] = array(
                'Name' => $row['Name'],
                'Quantity' => $row['Quantity'],
                'Price' => $row['Price']
            );
        }
        //Turn to JSON & output
        echo json_encode($re_equipments_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }

