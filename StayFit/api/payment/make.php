<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');
    
    include_once '../../config/Database.php';
    include_once '../../models/Payment.php';

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

    //Instantiate Payment object
    $payment = new Payment($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $payment->Payment_ID = $data->Payment_ID;
    $payment->Booking_ID = $data->Booking_ID;
    $payment->Amount_paid = $data->Amount_paid;
    $payment->Time = $data->Time;
    $payment->Date = $data->Date;
    $payment->Client_ID = $data->Client_ID;

    //Make Payment
    if($payment->make()){
        echo json_encode(
            array('message' => 'Payment made')
        );
    } else {
        echo json_encode(
            array('message' => 'Payment not made')
        );
    }
?>