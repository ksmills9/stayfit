<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Non_Members.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Purchasable equipment object
    $pu_equipment = new Non_Members($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    $pu_equipment->Client_ID = $data->Client_ID;
    $pu_equipment->last_visited_date = $data->last_visited_date;
    $pu_equipment->last_entry_time = $data->last_entry_time;
    $pu_equipment->last_exit_time = $data->last_exit_time;

    //Add equipment
    if($pu_equipment->add()) {
        echo json_encode(
            array('message' => 'Non-Member Added')
        );
    } else {
        echo json_encode(
            array('message' => 'Invalid Non-member details')
        );
    }
