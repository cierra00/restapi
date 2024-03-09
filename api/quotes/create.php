<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();


  // Instantiate blog quote object
  $quote = new Quote($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;

  $post_arr = array(
    #'id'=> $quote->create(),
    'quote'=> $quote->quote,
    'category_id'=>$quote->category_id,
    'author_id' =>$quote->author_id    
);
  // Create quote
  if (
    !empty($data->quote) && 
    !empty($author_id) && 
    !empty($category_id) 
    ) {

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