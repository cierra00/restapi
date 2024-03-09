<?php





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