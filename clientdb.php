<?php

require_once 'db.php';

class ClientDB extends DB {

  public function __construct() {
    parent::__construct();
    // $this->createTable();     // Uncomment on first use
  }

  public function createTable() {
    if (!$this->connected) return;
    $sql = "create table ". CL_TABLE ." (
            email varchar(40) not null)";

    if ($this->db->query($sql) === true) {
      echo "Created table!";
    } else {
      echo "Error " . $this->db->error;
    }
  }

  public function getClients() {
    if (!$this->connected) return;
    $clients = array();
    $sql = "select email from ". CL_TABLE;
    $result = $this->db->query($sql);

    while ($row = $result->fetch_array()) {
      $clients[] = $row['email'];
    }

    return $clients;
  }


}



 ?>
