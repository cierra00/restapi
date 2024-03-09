<?php

class Quote{

    #db declarations
    private $conn;
    private $table = 'quotes';

    # Quote Properties
    public $id;
    public $category_id;
    public $author_id;
    public $quote;
    public $category_name;
    public $author_name;
   

    #constructor with DB
    public function __construct($db){
     $this->conn = $db;
    }

    #Get Posts

    public function read() {
      // Create query
      $query = 'SELECT a.name AS author_name, q.quote, c.name as category_name, q.id, q.category_id, q.author_id FROM quotes q JOIN authors a ON a.id = q.author_id
      JOIN categories c on c.id = q.category_id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    #Read Single Quote
    public function read_single(){
      
         #create query
         $query = 'SELECT c.name as category_name, q.id as id, q.category_id as category_id, q.quote as quote, a.id as author_id, a.name as author_name
         FROM ' . $this->table . ' q
         LEFT JOIN categories c ON q.category_id = c.id
         LEFT JOIN authors a ON q.author_id = a.id
         WHERE
           q.id = ?';
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
        $this->quote = $row['quote'];
        $this->author_id = $row['author_id'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->author_name =$row['author_name'];
       }

       return $row;

    }

    #Create Quote
      // Create Post
    public function create() {
      // Create query
      $query = 'INSERT INTO quotes (quote, category_id, author_id)
      VALUES (:quote, :category_id, :author_id) RETURNING id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      $this->author_id = htmlspecialchars(strip_tags($this->author_id));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));

      // Bind data
      $stmt->bindParam(':quote', $this->quote);
      $stmt->bindParam(':author_id', $this->author_id);
      $stmt->bindParam(':category_id', $this->category_id);

       // Execute query
       if($stmt->execute()) {
        $idResource = $stmt->fetchColumn();
      return $idResource;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}





#Update Quote
public function update() {
  // Create query
  $query = 'UPDATE ' . $this->table . ' SET quote = :quote, id = :id, author_id = :author_id, category_id = :category_id
  WHERE id = :id';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->quote = htmlspecialchars(strip_tags($this->quote));
  $this->author_id = htmlspecialchars(strip_tags($this->author_id));
  $this->category_id = htmlspecialchars(strip_tags($this->category_id));

  // Bind data
  $stmt->bindParam(':id', $this->id);
  $stmt->bindParam(':quote', $this->quote);
  $stmt->bindParam(':author_id', $this->author_id);
  $stmt->bindParam(':category_id', $this->category_id);

  if($stmt->execute()) {
    $idResource = $stmt->fetchColumn();
  return $idResource;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);

return false;
}


#Delete Quote
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
  $send_id= array('id'=>$this->id);
  return $send_id;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);
}
}