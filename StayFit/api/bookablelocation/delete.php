<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

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
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $bookable_loc = new bookablelocation($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $bookable_loc->Space_ID = $data->Space_ID;

  // Delete post
  if($bookable_loc->delete()) {
    echo json_encode(
      array('message' => 'Space Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Space Delete Invalid')
    );
  }
