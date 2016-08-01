<?php

class ExamsDB {

  private $db;
  private $connected;

  public function __construct() {
    $this->setUpDB();
    // $this->createTable()    // Uncomment on first use
  }

  public function setUpDB() {
    $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($this->db->connect_error) {
      die("Connection failed: " . $this->db->connect_error);
    }
    echo "Connected!";
    $this->connected = true;
  }

  public function createTable($table) {
    if (!$this->connected) return;
    $sql = "create table ". $table ." (
      id varchar(20) not null,
      name varchar(50) not null
    )";

    if ($this->db->query($sql) === true) {
      echo "Created table!";
    } else {
      echo "Error " . $this->db->error;
    }
  }

  public function loadExams() {

  }

}


 ?>
