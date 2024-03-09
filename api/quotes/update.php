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

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update

  $quote->id = $data->id;
  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;
  
  $post_arr = array(
    'id'=> $quotes->id,
    'quote'=> $quotes->quote,
    #'author_id'=> $quotes->author_id,
    'category'=> $quotes->category_name,
    #'category_id'=> $quotes->category_id,
    'author' => $quotes->author_name   

);

  // Create quote
  if($quote->update()) {
    echo json_encode(
      $post_arr
    );
  } else {
    echo json_encode(
      array('message' => 'Quote Not updated')
    );
  }