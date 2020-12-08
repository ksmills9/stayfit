<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');
    
    include_once '../../config/Database.php';
    include_once '../../models/Booking.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    }else{
        if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to admins
        } 
        elseif(($_SERVER['PHP_AUTH_USER'] == 'Staff' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to staff
        } 
        else {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            print "Sorry, you need proper credentials";
            exit;
        }
    }

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

    //Edit booking
    if($eq_booking->edit()){
        echo json_encode(
            array('message' => 'Equipment Booking updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Equipment Booking not updated')
        );
    }
?>