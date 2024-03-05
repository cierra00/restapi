<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    require_once('../../config/Database.php');
    require_once('../../models/Quote.php');
   


     /* Initialization of variables*/
     $id = null;

     

    /* Database Connection */

    $database = new Database();
    $db = $database->connect();

    /* Category Object */

    $category = new Quote($db);

    // Handle ID from parameter in URL
    if ($method === 'GET' ||  'DELETE') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }
   
 echo $method;

  if ($method === 'GET' && !$id) { require_once('read.php');  };
  if ($method === 'GET' && $id) { require_once('read_single.php'); echo $method. "sucks"; };
  if ($method === 'POST') { require_once('create.php'); };
  if ($method === 'PUT' && $id) { require_once('update.php'); };
  if ($method === 'DELETE') { require_once('delete.php');} 
  else {
  
    echo "You Broke it ". $method;
}