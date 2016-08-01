<?php

require_once('../lib/phpQuery/phpQuery.php');

class ExamsParser {

  private $db;
  private $connected;

  public function __construct($html) {
    $doc = phpQuery::newDocument($html);
    phpQuery::selectDocument($doc);

    foreach (pq('#tab1 tr[id^="node0i"]') as $tr) {
        $ex =  pq(pq($tr)->find('td:eq(2) > span:first'))->text();
      }
    }

  public function getList() {

  }

  

}

 ?>
