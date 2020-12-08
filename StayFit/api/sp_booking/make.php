<?php
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
    $sp_booking = new Space_booking($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $sp_booking->Client_ID = $data->Client_ID;
    $sp_booking->Booking_ID = $data->Booking_ID;
    $sp_booking->Date = $data->Date;
    $sp_booking->Start_time = $data->Start_time;
    $sp_booking->End_time = $data->End_time;
    $sp_booking->No_of_guests = $data->No_of_guests;
    $sp_booking->Space_ID = $data->Space_ID;

    //Make booking
    if($sp_booking->make()){
        echo json_encode(
            array('message' => 'Space Booking made')
        );
    } else {
        echo json_encode(
            array('message' => 'Space Booking not made')
        );
    }
?>