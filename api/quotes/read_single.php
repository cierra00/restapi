<?php

#headers
header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//Instantiate DB & Connect

$database = new Database();
$db = $database->connect();


//Instantiate Blog Post
$quotes = new Quote($db);


#get ID from URL
$quotes->id = isset($_GET['id']) ? $_GET['id'] : die();

#Get Post 
$quotes->read_single();


#create array
$post_arr = array(
    'id'=> $quotes->id,
    'quote'=> $quotes->quote,
    #'author_id'=> $quotes->author_id,
    'category'=> $quotes->category_name,
    #'category_id'=> $quotes->category_id,
    'author' => $quotes->author_name   

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