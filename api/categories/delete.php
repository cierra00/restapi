<?php 
 



  //set id to update

  $category->id = $data->id;
  

  //Delete category
  if($category->delete()) {
    echo json_encode($category->delete());
  } else {
    echo json_encode(
      array('message' => 'Category Not Deleted')
    );
  }