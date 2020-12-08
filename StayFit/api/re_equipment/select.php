<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Rentable_equipment.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    } else {
        if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            print "You are in the private area";
        }

        else if(($_SERVER['PHP_AUTH_USER'] == 'Staff' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            print "You are in the private area";
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

    //Instantiate rentable equipment object
    $re_equipment = new Rentable_equipment($db);

    //Get ID
    $re_equipment->Equipment_ID = isset($_GET['Equipment_ID']) ? $_GET['Equipment_ID']: die();

    //Select 1 equipment according to the ID
    $re_equipment->select();

    $re_equipment_arr = array(
        'Equipment_ID' => $re_equipment->Equipment_ID,
        'Name' => $re_equipment->Name,
        'Quantity' => $re_equipment->Quantity,
        'Price' => $re_equipment->Price
    );

    //Format in json
    echo json_encode($re_equipment_arr);