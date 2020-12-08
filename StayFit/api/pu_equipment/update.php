<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

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

    //Instantiate purchasable equipment object
    $pu_equipment = new Purchasable_equipment($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $pu_equipment->Equipment_ID = $data->Equipment_ID;
    $pu_equipment->Name = $data->Name;
    $pu_equipment->Price = $data->Price;
    $pu_equipment->In_Stock = $data->In_Stock;

    //Update equipment
    if($pu_equipment->update()) {
        echo json_encode(
            array('message' => 'Purchasable Equipment Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Invalid Update Request')
        );
    }