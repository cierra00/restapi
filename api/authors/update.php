<?php 
 
  
  //set id to update

  $author->id = $data->id;
  $author->name = $data->name;
  

  // Create author from db
  if($author->update()) {
    echo json_encode(
      array('id' => $data->id,
      'author' => $data->name
      )
    );
  } else {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
  }