<?php

require_once 'db.php';

class ExamsDB extends DB {

  public function createTable() {
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



}


 ?>
