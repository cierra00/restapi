<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  $method = $_SERVER['REQUEST_METHOD'];
  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $author = new Author($db);

  // Get raw posted data
 
  $data = json_decode(file_get_contents("php://input"));

  

    $author->name = $data->name;
  
  
  // Create author
  if($author->create()&& $data !== null ) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }