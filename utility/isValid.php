

<?php 

function isValid($id, $table){
    $table->id = $id;
    return $table->read->single();
}

?>