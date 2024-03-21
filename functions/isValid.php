<?php 

#Calling read single to see if we get a true response if ID is in DB
function isValid($id, $db_OBJ) {
    $db_OBJ->id = $id;
  return $db_OBJ->read_single();
   
}