<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    $sp_booking->Booking_ID = $data->Booking_ID;

    //Delete booking
    if($sp_booking->delete()){
        echo json_encode(
            array('message' => 'Space Booking deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Space Booking not deleted')
        );
    }
?>