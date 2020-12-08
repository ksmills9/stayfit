<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Non_Members.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $bookable_loc = new Non_Members($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $bookable_loc->Client_ID = $data->Client_ID;

  // Delete post
  if($bookable_loc->delete()) {
    echo json_encode(
      array('message' => 'Non-members Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Non-members Delete Invalid')
    );
  }
