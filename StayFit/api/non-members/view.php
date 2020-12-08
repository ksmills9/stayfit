<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Non_Members.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $non_mem = new Non_Members($db);

    $result = $non_mem->view();
    $num = $result->rowCount();

    //Check for bookings
    if($num > 0){
        $non_mem_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $non_mem_arr[$row['Client_ID']] = array(
                'last_visited_date' => $row['last_visited_date'],
                'last_entry_time' => $row['last_entry_time'],
                'last_exit_time' => $row['last_exit_time']
            );
        }
        //Turn to JSON & output
        echo json_encode($non_mem_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }
