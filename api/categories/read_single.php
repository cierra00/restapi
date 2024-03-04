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
include_once '../../models/Category.php';

//Instantiate DB & Connect

$database = new Database();
$db = $database->connect();


//Instantiate Blog Category
$category = new Category($db);


#get ID from URL
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

#Get Category 
$category->read_single();

#create array
$post_arr = array(
    'id'=> $category->id,
    'category'=> $category->name,
    
);

if($category->id){
    print_r(json_encode($post_arr));
    } else {
        echo json_encode(
            array('message' => 'category_id Not Found')
          );
    }
?>