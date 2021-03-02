<?php 
  class Data {
    // DB stuff
    private $conn;
    private $table = 'dataList';

    //Properties
    public $id;
    public $name;
    public $surname;
    public $date;
    public $gender;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Data
    public function read() {
      // Create query
      $query = 'SELECT * FROM  ' . $this->table . ' ORDER BY id DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Data
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, surname = :surname, date = :date, gender = :gender';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->surname = htmlspecialchars(strip_tags($this->surname));
          $this->date = htmlspecialchars(strip_tags($this->date));
          $this->gender = htmlspecialchars(strip_tags($this->gender));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':surname', $this->surname);
          $stmt->bindParam(':date', $this->date);
          $stmt->bindParam(':gender', $this->gender);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Data
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET name = :name, surname = :surname, date = :date, gender = :gender
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->surname = htmlspecialchars(strip_tags($this->surname));
          $this->date = htmlspecialchars(strip_tags($this->date));
          $this->gender = htmlspecialchars(strip_tags($this->gender));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':surname', $this->surname);
          $stmt->bindParam(':date', $this->date);
          $stmt->bindParam(':gender', $this->gender);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Data
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }