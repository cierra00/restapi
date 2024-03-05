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
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog quote object
  $quote = new Quote($db);

  // Blog quote query
  $result = $quote->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Quotes
  if($num > 0) {
    // Post array
    $quotes = array();
    // $quotes['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'quote' => $quote,
        //'author_id' => html_entity_decode($author_id),     
        //'category_id' => $category_id,
        'category'=> $category_name,
        'author'=> $author_name
      );

      // Push to "data"
      array_push($quotes, $post_item);
      array_push($quotes['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($quotes);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }