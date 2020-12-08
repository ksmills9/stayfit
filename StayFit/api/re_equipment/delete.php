<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

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

  //Instantiate blog post object
  $re_equipment = new Rentable_equipment($db);

  //Get data
  $data = json_decode(file_get_contents("php://input"));

  //Set ID to delete
  $re_equipment->Equipment_ID = $data->Equipment_ID;

  //Delete post
  if($re_equipment->delete()) {
    echo json_encode(
      array('message' => 'Equipment Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Equipment Delete Invalid')
    );
  }