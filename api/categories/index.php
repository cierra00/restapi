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
  include_once '../../models/Category.php';



     /* Initialization of variables*/
     $id = null;

     
    /* Database Connection */

    $database = new Database();
    $db = $database->connect();

    /* Category Object */

    $category = new Category($db);

    // Handle ID from parameter in URL
    if ($method === 'GET') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }
   
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->id) && $method !== 'GET') { $id = $data->id; }


  if ($method === 'GET' && !$id) { require_once('read.php'); }
  if ($method === 'GET' && $id) { require_once('read_single.php'); }
  if ($method === 'POST') { require_once('create.php'); }
  if ($method === 'PUT' && $id) { require_once('update.php'); }
  if ($method === 'DELETE' && $id !== null) { require_once('delete.php'); }