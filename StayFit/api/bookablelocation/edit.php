<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/bookablelocation.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])){
      header ("WWW-Authenticate: Basic realm=\"Private Area\"");
      header ("HTTP/1.0 401 Unauthorised");
      print "Sorry, you need proper credentials";
      exit;
    }else{
      if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))){
        print "You are in the private area";
      }
      else{
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
      header ("HTTP/1.0 401 Unauthorised");
      print "Sorry, you need proper credentials.";
      exit;
      }
    }
    
    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Purchasable equipment object
    $bookable_loc = new bookablelocation($db);

    //Get data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $bookable_loc->Space_ID = $data->Space_ID;
    $bookable_loc->Space_name = $data->Space_name;
    $bookable_loc->Location = $data->Location;
    $bookable_loc->Capacity = $data->Capacity;
    $bookable_loc->Open_time = $data->Open_time;
    $bookable_loc->Close_time = $data->Close_time;
    $bookable_loc->Price = $data->Price;



    //Add equipment
    if($bookable_loc->edit()) {
        echo json_encode(
            array('message' => 'Bookable location was edited')
        );
    } else {
        echo json_encode(
            array('message' => 'Bookable location could not be edited')
        );
    }
