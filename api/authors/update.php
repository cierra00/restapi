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

  // Instantiate blog category object
  $category = new Author($db);

  // Get raw category data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update

  $category->id = $data->id;
  $category->name = $data->name;
  

  // Create category
  if($category->update()) {
    echo json_encode(
      array('id' => $data->id,
      "author"=> $data->name
      )
    );
  } else {
    echo json_encode(
      array('message' => 'Author Not updated')
    );
  }