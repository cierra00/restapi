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
    require_once('../../models/Category.php');
    require_once('../../models/Author.php');
    require_once('../../functions/isValid.php');
   


     /* Initialization of variables*/
      $id = null;
     

     

    /* Database Connection */

    $database = new Database();
    $db = $database->connect();

    /* Category Object */

    $quote = new Quote($db);
    $author = new Author($db);
    $category = new Category($db);


    // Handle ID from parameter in URL
    if ($method === 'GET') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
       
    }

     // DELETE and UPDATE/PUT need to validate the (quote) id parameter
     if ($method === 'DELETE' || $method === 'PUT') {
        $idExists = isValid($id, $quote);
        if (!$idExists) { 
            echo json_encode(
                array('message' => 'No Quotes Found')
            );
            
        }
    }
   


  if ($method === 'GET' && !$id) { require_once('read.php'); };
  if ($method === 'GET' && $id) { require_once('read_single.php'); };
  if ($method === 'POST') { require_once('create.php'); };
  if ($method === 'PUT' && $id) { require_once('update.php'); };
  if ($method === 'DELETE') { require_once('delete.php'); };