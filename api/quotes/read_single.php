<?php

#get ID from URL
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

#Get Post 
$quote->read_single();


#create array
$post_arr = array(
    'id'=> $quote->id,
    'quote'=> $quote->quote,
    #'author_id'=> $quote->author_id,
    'category'=> $quote->category_name,
    #'category_id'=> $quote->category_id,
    'author' => $quote->author_name   

);
function countNull($post_arr){
    $count = 0;
foreach($post_arr as $b){
    $count = 0;
    if($b === null){
        $count++;
       
    }
}
if($count >=1){
    echo json_encode(
        array('message' => 'No Quotes Found')
      );
    } else {
       
          print_r(json_encode($post_arr));
    }
}
countNull($post_arr);
?>