<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog author object
  $author = new Author($db);

  // Blog author query
  $result = $author->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any categories exist
  if($num > 0) {
    // Author array
    $cat_arr = array();
    // $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'author' => $name,
        
      );

      // Push to "data"
      array_push($cat_arr, $cat_item);
      // array_push($cat_arr['data'], $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);

  } else {
    // No Categories
    echo json_encode(
      array('message' => 'No Categories Found')
    );
  }