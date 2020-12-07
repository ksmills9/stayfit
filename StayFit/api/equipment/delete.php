<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Rentable_equipment.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $re_equipment = new Rentable_equipment($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $re_equipment->Equipment_ID = $data->Equipment_ID;

  // Delete post
  if($re_equipment->delete()) {
    echo json_encode(
      array('message' => 'Equipment Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Equipment Delete Invalid')
    );
  }