<?php  


  //set id to delete
  $quote->id = $data->id;
  
try{
  $quote->delete();
  echo json_encode($quote->delete());
}
catch(exception $e){
  echo json_encode(
    array('message' => 'No Quotes Found')
  );
}
 