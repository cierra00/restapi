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
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog category object
  $category = new Category($db);

  // Get raw category data
  $data = json_decode(file_get_contents("php://input"));

  $category->name = $data->name;
  $post_arr = array(
    'id'=> $category->create(),
    'category'=> $category->name,
    
);
if (!empty($data->category)) {

  $category->name = $data->category;

  try {
      $result = $category->create();
      echo json_encode($result);
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