<?php

class Author{

    #db declarations
    private $conn;
    private $table = 'authors';

    # Author Properties
    public $id;
    public $name;
   


    #constructor with DB
    public function __construct($db){
     $this->conn = $db;
    }

    #Get Author

    public function read() {
      // Create query
      $query = 'SELECT id, name FROM ' .$this->table . '
      ORDER BY name DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    #Read Single Author
    public function read_single(){
      
         #create query
          $query = 'SELECT id, name as author
                                    FROM ' . $this->table . '                                    
                                    WHERE
                                    id = ?';
                                    

          #Prepare Statement
        $stmt = $this->conn->prepare($query);

        #Bind ID
        $stmt->bindParam(1, $this->id);

        #Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        #Set Properties
        if($row){
        $this->id = $row['id'];
        $this->name = $row['author'];
        }

        return $row;


    }

   #Create Category
   public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . '(name) VALUES (:name)RETURNING id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    

    // Bind data
    $stmt->bindParam(':name', $this->name);
    
    

    

    // Execute query
    if($stmt->execute()) {
      return true;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);

return false;
}




#Update Author
public function update() {
  // Create query
  $query = 'UPDATE ' . $this->table . ' SET name = :name, id = :id
  WHERE id = :id';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->name = htmlspecialchars(strip_tags($this->name));
 

  // Bind data
  $stmt->bindParam(':id', $this->id);
  $stmt->bindParam(':name', $this->name);

  // Execute query
  if($stmt->execute()) {
    return true;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);

return false;
}


#Delete Author
public function delete(){
  #query
  $query ='DELETE FROM ' .$this->table . ' WHERE id = :id';
  //Prepare statement
  $stmt = $this->conn->prepare($query);


  #Clean Data
  $this->id = htmlspecialchars(strip_tags($this->id));

  #bind Data
  $stmt->bindParam(':id', $this->id);


#Execute Query
if($stmt->execute()){
  return true;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);
}
}