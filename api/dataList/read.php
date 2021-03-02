<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Data.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tData = new Data($db);

  // Blog post query
  $result = $tData->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $tData_arr = [];
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $tData_item = [
        'id' => $id,
        'name' => $name,
        'surname' => $surname,
        'date' => $date,
        'gender' => $gender,
      ];

      // Push to "data"
      array_push($tData_arr, $tData_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($tData_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Data Found')
    );
  }
