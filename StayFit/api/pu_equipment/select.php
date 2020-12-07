<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Purchasable_equipment.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate purchaseable equipment object
    $pu_equipment = new Purchasable_equipment($db);

    //Get ID
    $pu_equipment->Equipment_ID = isset($_GET['Equipment_ID']) ? $_GET['Equipment_ID']: die();

    //Select
    $pu_equipment->select();

    $pu_equipment_arr = array(
        'Equipment_ID' => $pu_equipment->Equipment_ID,
        'Name' => $pu_equipment->Name,
        'Price' => $pu_equipment->Price,
        'In_Stock' => $pu_equipment->In_Stock
    );

    //Format in json
    echo json_encode($pu_equipment_arr);