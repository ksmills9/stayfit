<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Rentable_equipment.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Purchasable equipment object
    $re_equipment = new Rentable_equipment($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $re_equipment->Equipment_ID = $data->Equipment_ID;
    $re_equipment->Name = $data->Name;
    $re_equipment->Quantity = $data->Quantity;
    $re_equipment->Price = $data->Price;

    //Add equipment
    if($re_equipment->update()) {
        echo json_encode(
            array('message' => 'Rentable Equipment Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Invalid Update Request')
        );
    }