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
  include_once '../../functions/isValid.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog quote object
  $quote = new Quote($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  //set id to update

  $quote->id = $data->id;
  $id= $data->id;
  
  $idExists = isValid($id, $quote);
  if (!$idExists) { 
      echo json_encode(
          array('message' => 'No Quotes Found')
      );
      
  }
  //Delete quote
  if($quote->delete()) {
    echo json_encode($quote->delete());
  } else {
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }