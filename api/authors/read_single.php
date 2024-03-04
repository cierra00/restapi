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
include_once '../../models/Author.php';

//Instantiate DB & Connect

$database = new Database();
$db = $database->connect();


//Instantiate Blog Author
$author = new Author($db);


#get ID from URL
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

#Get Single Author 
$author->read_single();

#create array
$post_arr = array(
    'id'=> $author->id,
    'author'=> $author->name,
    
);

if($author->id){
    print_r(json_encode($post_arr));
    } else {
        echo json_encode(
            array('message' => 'author_id Not Found')
          );
    }
?>