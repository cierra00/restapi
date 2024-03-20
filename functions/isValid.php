<?php 

// Does id exist?
function isValid($id, $db_OBJ) {
    $db_OBJ->id = $id;
  return $db_OBJ->read_single();
   
}