<?php 
  


  

    $author->name = $data->name;
    $post_arr = array(
      'id'=> $author->create(),
      'author'=> $author->name,
      
  );
  
  if (!empty($data->author)) {

    $author->name = $data->author;
    
    try {
        $result = $author->create();
        echo json_encode($post_arr);
    } catch (Exception $e) {
        echo json_encode(
            array('message' => $e->getMessage())
        );
    }
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
exit();