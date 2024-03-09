<?php 


  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog author object
  $author = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update

  $author->id = $data->id;
  

  //Delete author
  if($author->delete()) {
    echo json_encode($author->delete());
  } else {
    echo json_encode(
      array('message' => 'Author Not Deleted')
    );
  }