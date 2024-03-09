<?php 
 
   //set id to update
   if (
    !empty($data->quote) && 
    !empty($author_id) && 
    !empty($category_id) && 
    !empty($id)
    ) {
    }
  $quote->id = $data->id;
  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;
  
  

  // Create quote
  if (
    !empty($data->quote) && 
    !empty($author_id) && 
    !empty($category_id) && 
    !empty($id)
    ) { try{
      $output = $quote->update();
      echo json_encode($output);
    } catch(Exception $e){
    
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