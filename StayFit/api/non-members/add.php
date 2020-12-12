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

    //Instantiate Non_Members object
    $non_mem = new Non_Members($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    $non_mem->Client_ID = $data->Client_ID;
    $non_mem->FirstName = $data->FirstName;
    $non_mem->LastName = $data->LastName;
    $non_mem->Client_ID = $data->Client_ID;
    $non_mem->last_visited_date  = $data->last_visited_date;
    $non_mem->last_entry_time  = $data->last_entry_time ;
    $non_mem->last_exit_time  = $data->last_exit_time ;



    //Add Non-member
    if($non_mem->add()) {
        echo json_encode(
            array('message' => 'Non-Member Client Added')
        );
    } else {
        echo json_encode(
            array('message' => 'Invalid Non-member details')
        );
    }
