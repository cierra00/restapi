<?php 
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog category object
  $category = new Category($db);

 

  $category->name = $data->name;
  $post_arr = array(
    'id'=> $category->create(),
    'category'=> $category->name,
    
);
if (!empty($data->category)) {

  $category->name = $data->category;

  try {
      $result = $category->create();
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