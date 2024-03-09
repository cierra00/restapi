<?php 
 

  // Blog quote query
  $result = $quote->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Quotes
  if($num > 0) {
    // Post array
    $quotes = array();
    // $quote['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'quote' => $quote,
        //'author_id' => html_entity_decode($author_id),     
        //'category_id' => $category_id,
        'category'=> $category_name,
        'author'=> $author_name
      );

      // Push to "data"
      array_push($quotes, $post_item);
      // array_push($quote['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($quotes);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }