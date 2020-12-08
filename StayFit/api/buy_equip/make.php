<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Buy.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $eq_booking = new buy($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $eq_booking->Equipment_ID = $data->Equipment_ID;
    $eq_booking->Client_ID = $data->Client_ID;
    $eq_booking->Purchase_ID = $data->Purchase_ID;
    $eq_booking->Time = $data->Time;
    $eq_booking->Date = $data->Date;
    $eq_booking->Quantity = $data->Quantity;


    //Make booking
    if($eq_booking->make()){
        echo json_encode(
            array('message' => ' Purchase successful!')
        );
    } else {
        echo json_encode(
            array('message' => 'Purchase UNsuccessful!')
        );
    }
?>
