<?php

class DB {

  protected $db;
  protected $connected;

  public function __construct() {
    $this->db = null;
    $this->connected = false;
    $this->setUpDB();
  }

  public function setUpDB() {
    $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($this->db->connect_error) {
      die("Connection failed: " . $this->db->connect_error);
    }
    $this->db->query("SET NAMES 'utf8'");
    echo "Connected!";
    $this->connected = true;
  }

}


 ?>
