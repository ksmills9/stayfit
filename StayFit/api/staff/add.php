<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Staff.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    }else{
        if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to admins
        } /*
        elseif(($_SERVER['PHP_AUTH_USER'] == 'Staff' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to staff
        } */
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

    //Instantiate equipment booking object
    $staff = new Staff($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $staff->Staff_ID = $data->Staff_ID;
    $staff->FirstName = $data->FirstName;
    $staff->LastName = $data->LastName;
    $staff->JobTitle = $data->JobTitle;

    
     //add Staff
     if($staff->add()){
        echo json_encode(
            array('message' => 'Staff added')
        );
    } else {
        echo json_encode(
            array('message' => 'Staff not added')
        );
    }


?>