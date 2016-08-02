<?php

require_once 'db.php';

class ExamsDB extends DB {

  public function __construct() {
    parent::__construct();
    // $this->createExamsTable();     // Uncomment on first use
    // $this->createLogTable();
  }


  public function createExamsTable() {
    if (!$this->connected) return;
    $sql = "create table ". EX_TABLE ." (
      id varchar(20) not null,
      name varchar(50) not null
    )";

    if ($this->db->query($sql) === true) {
      echo "Created table!";
    } else {
      echo "Error " . $this->db->error;
    }
  }

  public function createLogTable() {
    if (!$this->connected) return;
    $sql = "create table ". LOG_TABLE ." (
      time datetime not null,
      new_count integer(50),
      updates varchar(120)
    )";

    if ($this->db->query($sql) === true) {
      echo "Created table!";
    } else {
      echo "Error " . $this->db->error;
    }
  }

  public function loadExams() {
    if (!$this->connected) return;
    $sql = "select id, name from ". EX_TABLE;
    $result = $this->db->query($sql);
    $exams = array();
    while ($row = $result->fetch_array()) {
      $exams[$row['id']] = $row['name'];
    }
    return $exams;

  }

  public function storeExams($updates) {
    if (!$this->connected) return;
    $stm = $this->db->prepare("insert into ". EX_TABLE ." (id, name) values (?,?)");
    $stm->bind_param("ss", $id, $name);

    foreach ($updates as $id => $name) {
      $stm->execute();
    }
  }

  public function log($updates) {
    if (!$this->connected) return;
    $stm = $this->db->prepare("insert into jenotify_logs (time, new_count, updates) values (?,?,?)");
    $stm->bind_param("sss", $time, $count, $update);

    $time = date("Y-m-d H:i:s", strtotime('+2 hours')); //date("Y-m-d H:i:s");
    $count = count($updates);
    $update = join(";", $updates);

    $stm->execute();
  }

  public function getStatus() {
    if (!$this->connected) return;
    $sql = "select MAX(time) from ". LOG_TABLE;
    $result = $this->db->query($sql);
    return $result->fetch_array()[0];
  }

  public function close() {
    $this->db->close();
  }


}


 ?>
