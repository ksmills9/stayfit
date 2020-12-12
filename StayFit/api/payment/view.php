<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

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

    //Instantiate payment object
    $payment = new Payment($db);

    if(isset($_GET['Payment_ID'])){
        //Get Payments
        $Payment->Payment_ID = $_GET['Payment_ID'];

        //Get Payments
        $result = $payment->select();
        $num = $result->rowCount();
        
        //Check for PAyments
        if($num > 0){
            $payment_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $payment_arr[$row['Payment_ID']] = array(
                    'Payment_ID' => $row['Payment_ID'],
                    'Booking_ID' => $row['Booking_ID'],
                    'Amount_paid' => $row['Amount_paid'],
                    'Time' => $row['Time'],
                    'Date' => $row['Date'],
                    'Client_ID' => $row['Client_ID']
                );
            }
            //Turn to JSON & output
            echo json_encode($payment_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }

    else{
        $result = $payment->view();
        $num = $result->rowCount();

        //Check for bookings
        if($num > 0){
            $payment_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $payment_arr[$row['Payment_ID']] = array(
                    'Payment_ID' => $row['Payment_ID'],
                    'Booking_ID' => $row['Booking_ID'],
                    'Amount_paid' => $row['Amount_paid'],
                    'Time' => $row['Time'],
                    'Date' => $row['Date'],
                    'Client_ID' => $row['Client_ID']
                );
            }
            //Turn to JSON & output
            echo json_encode($payment_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }

?>
