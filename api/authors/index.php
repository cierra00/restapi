<?php 
  // Headers
 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  $method = $_SERVER['REQUEST_METHOD'];

  if ($method === 'OPTIONS') {
      header('Access-Control-Allow-Methods: POST, PUT, DELETE');
      header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
      exit();
  }


  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  require_once('../../functions/isValid.php');



     /* Initialization of variables*/
     $id = null;

     

    /* Database Connection */

    $database = new Database();
    $db = $database->connect();

    /* Category Object */

    $author = new Author($db);

    // Handle ID from parameter in URL
    if ($method === 'GET') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }
   


    // Parameters sent with POST, PUT, and DELETE methods
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && $method !== 'GET') { $id = $data->id; }
    
    // All methods except POST need to confirm the id if submitted
    if ($method !== 'POST' && $id) {
        $authorExists = isValid($id, $author);
        if (!$authorExists) { 
            echo json_encode(
                array('message' => 'author_id Not Found')
            );
            exit();
        }
    }

    
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && $method !== 'GET') { $id = $data->id; }


    
 

  if ($method === 'GET' && !$id) { require_once('read.php'); };
  if ($method === 'GET' && $id) { require_once('read_single.php'); };
  if ($method === 'POST') { require_once('create.php'); };
  if ($method === 'PUT' && $id) { require_once('update.php'); };
  if ($method === 'DELETE' && $id !== null) { require_once('delete.php'); };