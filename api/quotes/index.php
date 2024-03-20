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
    require_once('../../models/Author.php');
    require_once('../../models/Category.php');  
    require_once('../../functions/isValid.php'); 
   


     /* Initialization of variables*/
     $id = null;
     $author_id = null;
     $category_id = null;
     $random = null;
     
   $data = json_decode(file_get_contents("php://input"));
   if (!empty($data->id) && $method !== 'GET')  { $id = $data->id; };
   if (!empty($data->author_id) && $method !== 'GET')  { $author_id = $data->author_id; };
   if (!empty($data->category_id) && $method !== 'GET')  { $category_id = $data->category_id; };
    
   
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
        $author_id = filter_input(INPUT_GET, 'author_id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        if (!$id) { 
            require_once('read.php'); 
        };
        if ($id) 
        { 
            require_once('read_single.php');
         };
    }
   
  if ($method === 'POST') { 
  if(!isValid($data->author_id, $author)){
    echo json_encode(array('message'=> 'author_id Not Found'));
  } 
  
  if(!isValid($data->category_id_id, $category)){
    echo json_encode(array('message'=> 'category_id Not Found'));
  } else {
    require_once('create.php'); 
  }
    }

    if ($method === 'PUT') { 
        if(!isValid($data->category_id_id, $category)){
          echo json_encode(array('message'=> 'category_id Not Found'));
        } else {
          require_once('update.php'); 
        }
          }
  




  if ($method === 'PUT' && $id) {
     require_once('update.php'); };
  if ($method === 'DELETE') { require_once('delete.php'); };
  