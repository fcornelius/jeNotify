<?php

require_once('../lib/phpQuery/phpQuery.php');

class ExamsParser {

  private $parsed;

  public function __construct($html) {
    $doc = phpQuery::newDocument($html);
    phpQuery::selectDocument($doc);
    $this->parsed = array();

    }

  public function getUpdates($exams) {
    $updates = array();
    foreach (pq('#tab1 tr[id^="node0i"]') as $tr) {
        $ex =  pq(pq($tr)->find('td:eq(2) > span:first'))->text();
        list($id, $name) = explode(" ", $ex, 2);
        $this->parsed[$id] = $name;

        if (!array_key_exists($id, $exams)) {
          $updates[$id] = $name;
        }
      }
      return $updates;
  }

  public function debugOutput($exams, $updates) {

    echo "<br><br>parsed: <br>";
    foreach ($this->parsed as $key => $value) {
      echo "-". $key . "_". $value . "-<br>";
    }
    echo "<br><br>exams: <br>";
    foreach ($exams as $key => $value) {
      echo "-". $key . "_". $value . "-<br>";
    }
    echo "<br>updates: <br>";
    foreach ($updates as $key => $value) {
      echo "-". $key . "_". $value . "-<br>";
    }
  }



}

 ?>
