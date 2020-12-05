<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Booking.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $eq_booking = new Equipment_booking($db);

    if(isset($_GET['Booking_ID'])){
        //Get Booking ID
        $eq_booking->Booking_ID = $_GET['Booking_ID'];

        //Get Equipment Bookings
        $result = $eq_booking->select();
        $num = $result->rowCount();
        
        //Check for bookings
        if($num > 0){
            $eq_bookings_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $eq_bookings_arr[$row['Booking_ID']] = array(
                    'Booking_ID' => $row['Booking_ID'],
                    'Client_ID' => $row['Client_ID'],
                    'Date' => $row['Date'],
                    'Start_time' => $row['Start_time'],
                    'End_time' => $row['End_time'],
                    'Equipment_ID' => $row['Equipment_ID'],
                    'Quantity_book' => $row['Quantity_booked']
                );
            }
            //Turn to JSON & output
            echo json_encode($eq_bookings_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }

    else{
        $result = $eq_booking->view();
        $num = $result->rowCount();

        //Check for bookings
        if($num > 0){
            $eq_bookings_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $eq_bookings_arr[$row['Booking_ID']] = array(
                    'Booking_ID' => $row['Booking_ID'],
                    'Client_ID' => $row['Client_ID'],
                    'Date' => $row['Date'],
                    'Start_time' => $row['Start_time'],
                    'End_time' => $row['End_time'],
                    'Equipment_ID' => $row['Equipment_ID'],
                    'Quantity_book' => $row['Quantity_booked']
                );
            }
            //Turn to JSON & output
            echo json_encode($eq_bookings_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }

?>
