<?php 
 
  
  //set id to update

  $author->id = $data->id;
  $author->name = $data->name;
  

  // Create author from db
  if (
    !empty($data->name)  && !empty($id)
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