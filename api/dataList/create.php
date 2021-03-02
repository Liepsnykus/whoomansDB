<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $tData->name = $data->name;
  $tData->surname = $data->surname;
  $tData->date = $data->date;
  $tData->gender = $data->gender;

  // Create post
  if($tData->create()) {
    echo json_encode(
      array('message' => 'Data Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Data Not Created')
    );
  }

