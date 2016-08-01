<?php

require_once('../lib/phpQuery/phpQuery.php');

class ExamsParser {

  private $db;
  private $connected;

  public function __construct($html) {
    $doc = phpQuery::newDocument($html);
    phpQuery::selectDocument($doc);

    }

  public function getUpdates($exams) {
    $updates = array();
    foreach (pq('#tab1 tr[id^="node0i"]') as $tr) {
        $ex =  pq(pq($tr)->find('td:eq(2) > span:first'))->text();
        list($id, $name) = explode(" ", $ex, 2);
        echo "-".$id. "_". $name. "-" . "<br>";
        if (!array_key_exists($id, $exams)) {
          $updates[$id] = $name;
        }
      }
      return $updates;
  }



}

 ?>
