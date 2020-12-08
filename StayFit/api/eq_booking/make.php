<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');
    
    include_once '../../config/Database.php';
    include_once '../../models/Booking.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $eq_booking = new Equipment_booking($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $eq_booking->Client_ID = $data->Client_ID;
    $eq_booking->Booking_ID = $data->Booking_ID;
    $eq_booking->Date = $data->Date;
    $eq_booking->Start_time = $data->Start_time;
    $eq_booking->End_time = $data->End_time;
    $eq_booking->Equipment_ID = $data->Equipment_ID;
    $eq_booking->Quantity_booked = $data->Quantity_booked;

    //Make booking
    if($eq_booking->make()){
        echo json_encode(
            array('message' => 'Equipment Booking made')
        );
    } else {
        echo json_encode(
            array('message' => 'Equipment Booking not made')
        );
    }
?>