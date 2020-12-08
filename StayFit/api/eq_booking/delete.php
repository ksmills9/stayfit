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
    $eq_booking = new Equipment_booking($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $eq_booking->Booking_ID = $data->Booking_ID;

    //Delete booking
    if($eq_booking->delete()){
        echo json_encode(
            array('message' => 'Equipment Booking deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Equipment Booking not deleted')
        );
    }
?>