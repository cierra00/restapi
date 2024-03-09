<?php 
  

  // Blog category query
  $result = $category->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any categories exist
  if($num > 0) {
    // Category array
    $cat_arr = array();
    // $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'category' => $name,
        
      );

      // Push to "data"
      array_push($cat_arr, $cat_item);
      // array_push($cat_arr['data'], $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);

  } else {
    // No Categories
    echo json_encode(
      array('message' => 'No Categories Found')
    );
  }