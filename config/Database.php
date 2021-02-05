<?php
include_once ('./vendor/autoload.php');

// Load in environmental vars
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

class Database {
  private $db_host = DB_HOST;
  private $db_name = DB_NAME;
  private $db_username = DB_USERNAME;
  private $db_password = DB_PASSWORD;
  private $conn;

  public function connect() {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:dbhost=$this->db_host;dbname=$this->db_name", $this->db_username, $this->db_password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Connection Error ' . $e->getMessage();
    }

    return $this->conn;
  }
}