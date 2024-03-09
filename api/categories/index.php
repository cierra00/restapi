<?php 
   

     /* Initialization of variables*/
     $id = null;

      // Get raw category data
  $data = json_decode(file_get_contents("php://input"));

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