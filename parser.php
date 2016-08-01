<?php

require_once('../lib/phpQuery/phpQuery.php');

class ExamsParser {

  private $doc;

  public function __construct($html) {
    $this->doc = phpQuery::newDocument($html);
    phpQuery::selectDocument($this->doc);

    foreach (pq('#tab1 tr[id^="node0i"]') as $tr) {
        $ex =  pq(pq($tr)->find('td:eq(2) > span:first'))->text();

      }

    }


  public function getList() {

  }

}

 ?>
