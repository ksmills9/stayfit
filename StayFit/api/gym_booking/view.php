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
    $gym_booking = new Gym_booking($db);

    if(isset($_GET['Booking_ID'])){
        //Get Booking ID
        $gym_booking->Booking_ID = $_GET['Booking_ID'];

        //Get Equipment Bookings
        $result = $gym_booking->select();
        $num = $result->rowCount();
        
        //Check for bookings
        if($num > 0){
            $gym_bookings_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $gym_bookings_arr[$row['Booking_ID']] = array(
                    'Booking_ID' => $row['Booking_ID'],
                    'Client_ID' => $row['Client_ID'],
                    'Date' => $row['Date'],
                    'Start_time' => $row['Start_time'],
                    'End_time' => $row['End_time'],
                    'No_of_guests' => $row['No_of_guests'],
                    'Space_ID' => $row['Space_ID']
                );
            }
            //Turn to JSON & output
            echo json_encode($gym_bookings_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }

    else{
        $result = $gym_booking->view();
        $num = $result->rowCount();

        //Check for bookings
        if($num > 0){
            $gym_bookings_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $gym_bookings_arr[$row['Booking_ID']] = array(
                    'Booking_ID' => $row['Booking_ID'],
                    'Client_ID' => $row['Client_ID'],
                    'Date' => $row['Date'],
                    'Start_time' => $row['Start_time'],
                    'End_time' => $row['End_time'],
                    'No_of_guests' => $row['No_of_guests'],
                    'Space_ID' => $row['Space_ID']
                );
            }
            //Turn to JSON & output
            echo json_encode($gym_bookings_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }

?>
