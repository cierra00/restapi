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
        } else {
          $this->id = null;
          $this->name = null;
          
        }

       
    }