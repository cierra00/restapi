<?php  


  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;

  $post_arr = array(
    'id'=> $quote->id,
    'quote'=> $quote->quote,
    'category_id'=>$quote->category_id,
    'author_id' =>$quote->author_id    
);
  // Create quote
  if ($quote->create()) {
  
        $quote->quote = $data->quote;
        $quote->author_id = $author_id;
        $quote->category_id = $category_id;
        
        try {
            $result = $quote->create();
            echo json_encode($post_arr);
        } catch (Exception $e) {
            echo json_encode(
                array('message' => $e->getMessage())
            );
        }
    }   else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }
    exit();
    //test