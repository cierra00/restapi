<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  $method = $_SERVER['REQUEST_METHOD'];
  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  include_once '../../functions/isValid.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $author = new Author($db);

  // Get raw posted data
 
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
  

    $author->name = $data->name;
    $post_arr = array(
      'id'=> $author->create(),
      'author'=> $author->name,
      
  );
  
  // Create author
  if($author->create()&& $data !== null ) {
    print_r(json_encode($post_arr));
    
  
  } else {
    echo json_encode(
      array('message' => 'author_id Not Found')
    );
  }