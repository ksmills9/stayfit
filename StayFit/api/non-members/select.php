<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Non_Members.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment purchase object
    $non_mem = new Non_Members($db);

    //Get ID
    $non_mem->Client_ID = isset($_GET['Client_ID']) ? $_GET['Client_ID']: die();

    //Select
    $non_mem->select();

    //Check for bookings

            $non_mem_arr = array(
               'Client_ID' => $non_mem->Client_ID,
                'last_visited_date' => $non_mem->last_visited_date,
                'last_entry_time' => $non_mem->last_entry_time,
                'last_exit_time' => $non_mem->last_exit_time

            );

        //Turn to JSON & output
        echo json_encode($non_mem_arr);
