<?php






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