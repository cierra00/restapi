<?php 
 

  //set id to update

  $category->id = $data->id;
  $category->name = $data->name;
  

  // Create category from db
  if($category->update()) {
    echo json_encode(
      array('id' => $data->id,
      'category' => $data->name
      )
    );
  } else {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
  }