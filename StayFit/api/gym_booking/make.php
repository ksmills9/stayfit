<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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
    $gym_booking = new Gym_booking($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $gym_booking->Client_ID = $data->Client_ID;
    $gym_booking->Booking_ID = $data->Booking_ID;
    $gym_booking->Date = $data->Date;
    $gym_booking->Start_time = $data->Start_time;
    $gym_booking->End_time = $data->End_time;
    $gym_booking->No_of_guests = $data->No_of_guests;
    $gym_booking->Space_ID = $data->Space_ID;

    //Make booking
    if($gym_booking->make()){
        echo json_encode(
            array('message' => 'Gym Booking made')
        );
    } else {
        echo json_encode(
            array('message' => 'Gym Booking not made')
        );
    }
?>