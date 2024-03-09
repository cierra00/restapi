<?php 
 
   //set id to update
   if (
    !empty($data->category) && !empty($id)
    ) {
    }
  $category->id = $data->id;
  $category->category = $data->category;
  
  
  

  // Create category
  if (
    !empty($data->category) && 
    
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
  
 
    
  // } else {
  //   echo json_encode(
  //     array('message' => 'Missing Required Parameters')
  //   );
  // }