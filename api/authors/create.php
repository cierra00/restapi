<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  $method = $_SERVER['REQUEST_METHOD'];
  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $author = new Author($db);

  // Get raw posted data
 
  $data = json_decode(file_get_contents("php://input"));

  

    $author->name = $data->name;
    $post_arr = array(
      'id'=> $author->create(),
      'author'=> $author->name,
      
  );
  
  if (!empty($data->author)) {

    $author->name = $data->author;
    
    try {
        $result = $author->create();
        echo json_encode($post_arr);
    } catch (Exception $e) {
        echo json_encode(
            array('message' => $e->getMessage())
        );
    }
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
exit();