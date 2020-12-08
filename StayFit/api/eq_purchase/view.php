<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Equipment_purchase.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment purchase object
    $eq_purchase = new Equipment_purchase($db);

    $result = $eq_purchase->view();
    $num = $result->rowCount();

    //Check for bookings
    if($num > 0){
        $eq_purchase_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $eq_purchase_arr[$row['Purchase_ID']] = array(
                'Time' => $row['Time'],
                'Date' => $row['Date'],
                'Quantity' => $row['Quantity']
            );
        }
        //Turn to JSON & output
        echo json_encode($eq_purchase_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }
