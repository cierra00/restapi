<?php 
 
   //set id to update
   if (
    !empty($data->author) && !empty($id)
    ) {
    }
  $author->id = $data->id;
  $author->author = $data->author;  
  

  // Create author
  if (
    !empty($data->author) && 
    
    !empty($id)
    ) { try{
      $output = $author->update();
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
  
 
    
