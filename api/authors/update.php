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

  // Get raw author data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update

  $author->id = $data->id;
  $author->name = $data->name;
  

  // Create author from db
  if($author->update()) {
    echo json_encode(
      array('id' => $data->id,
      'author' => $data->name
      )
    );
  } else {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
  }