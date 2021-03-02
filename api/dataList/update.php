<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Data.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tData = new Data($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $tData->id = $data->id;

  $tData->name = $data->name;
  $tData->surname = $data->surname;
  $tData->date = $data->date;
  $tData->gender = $data->gender;

  // Update post
  if($tData->update()) {
    echo json_encode(
      array('message' => 'Data Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Data Not Updated')
    );
  }

