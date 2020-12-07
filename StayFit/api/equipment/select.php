<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Rentable_equipment.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate purchaseable equipment object
    $re_equipment = new Rentable_equipment($db);

    //Get ID
    $re_equipment->Equipment_ID = isset($_GET['Equipment_ID']) ? $_GET['Equipment_ID']: die();

    //Select
    $re_equipment->select();

    $re_equipment_arr = array(
        'Equipment_ID' => $re_equipment->Equipment_ID,
        'Name' => $re_equipment->Name,
        'Quantity' => $re_equipment->Quantity,
        'Price' => $re_equipment->Price
    );

    //Format in json
    echo json_encode($re_equipment_arr);