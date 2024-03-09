<?php 
 

  //set id to update

  $category->id = $data->id;
  $category->name = $data->name;
  

  // Create category from db
  if (
    !empty($data->category) && 
    !empty($author_id) && 
    !empty($category_id) && 
    !empty($id)
    ) { try{
      $output = $category->update();
      echo json_encode($output);
    } catch(Exception $e){
      echo json_encode(
        array('message' => $e->getMessage())
    );
    }}  else {
      echo json_encode(
          array('message' => 'Missing Required Parameters')
      );
  }
  