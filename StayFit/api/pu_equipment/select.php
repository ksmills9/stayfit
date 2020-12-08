<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Purchasable_equipment.php';

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

    //Instantiate purchaseable equipment object
    $pu_equipment = new Purchasable_equipment($db);

    //Get ID
    $pu_equipment->Equipment_ID = isset($_GET['Equipment_ID']) ? $_GET['Equipment_ID']: die();

    //Select 1 equipment according to the ID
    $pu_equipment->select();

    $pu_equipment_arr = array(
        'Equipment_ID' => $pu_equipment->Equipment_ID,
        'Name' => $pu_equipment->Name,
        'Price' => $pu_equipment->Price,
        'In_Stock' => $pu_equipment->In_Stock
    );

    //Format in json
    echo json_encode($pu_equipment_arr);