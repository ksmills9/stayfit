<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Purchasable_equipment.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Purchasable equipment object
    $pu_equipment = new Purchasable_equipment($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $pu_equipment->Equipment_ID = $data->Equipment_ID;
    $pu_equipment->Name = $data->Name;
    $pu_equipment->Price = $data->Price;
    $pu_equipment->In_Stock = $data->In_Stock;

    //Add equipment
    if($pu_equipment->update()) {
        echo json_encode(
            array('message' => 'Purchasable Equipment Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Invalid Update Request')
        );
    }