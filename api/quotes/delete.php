<?php  


  //set id to delete
  $quote->id = $data->id;
  

  //Delete quote
  if($quote->delete()) {
    echo json_encode($quote->delete());
  } else {
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }