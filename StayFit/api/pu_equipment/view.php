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

    //Instantiate purchasable equipment object
    $pu_equipment = new Purchasable_equipment($db);
    $result = $pu_equipment->view();
    $num = $result->rowCount();

    //View purchasable equipments
    if($num > 0){
        $pu_equipments_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $pu_equipments_arr[] = array(
                'Equipment_ID ' => $row['Equipment_ID'],
                'Name' => $row['Name'],
                'Price' => $row['Price'],
                'In_Stock' => $row['In_Stock']
            );
        }
        //Turn to JSON & output
        echo json_encode($pu_equipments_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }

