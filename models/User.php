<?php
class User {
  // DB stuff
  private $conn;
  private $table = 'users';

  // Properties
  public $id;
  public $name;
  public $email;
  public $password;

  // Constructor with db
  public function __construct($db) {
    $this->conn = $db;
  }

  // Read one person
  public function read_single() {
    $query = 'SELECT id, name, email, password FROM ' . $this->table . ' WHERE email =  ?';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind param
    $stmt->bindParam(1, $this->email);

    // Execute statement
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    // Check if user was found
    if (isset($row['name'])) {
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->email = $row['email'];
      $this->password = $row['password'];
    }
  }
  
  // Create user account
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' SET name = :name, email = :email, password = :password';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $name = htmlspecialchars(strip_tags($this->name));
    $email = htmlspecialchars(strip_tags($this->email));
    $password = htmlspecialchars(strip_tags($this->password));

    // Bind params
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    // Execute
    if($stmt->execute()) {
      return true;
    }

    return printf("Error %s. \n" . $stmt->error());
  }
}