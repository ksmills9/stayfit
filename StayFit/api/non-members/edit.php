<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Non_Members.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Purchasable equipment object
    $non_mem = new Non_Members($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $non_mem->Client_ID = $data->Client_ID;
    $non_mem->last_visited_date = $data->last_visited_date;
    $non_mem->last_entry_time = $data->last_entry_time;
    $non_mem->last_exit_time = $data->last_exit_time;



    //Add equipment
    if($non_mem->edit()) {
        echo json_encode(
            array('message' => 'Non member updated their information')
        );
    } else {
        echo json_encode(
            array('message' => 'Non member could not updated their information')
        );
    }
