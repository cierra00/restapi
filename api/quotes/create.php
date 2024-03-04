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


//Instantiate Blog Quote
$quote = new Quote($db);

#Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));

$quote->quote = $data->quote;
//$quote->id = $data->id;
//$quote->author_id = $data->author_id;
//$quote->category_id = $data->category_id;

#Create Quote
if($quote->create()){
    echo json_encode($quote->create());
} else {
    echo json_encode(
        array('message'=>'Quote Not Created')
    );
}