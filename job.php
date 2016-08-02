
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>

<?php

require_once 'config.php';
require_once 'classes/connector.php';
require_once 'classes/parser.php';
require_once 'classes/examsdb.php';
require_once 'classes/clientdb.php';
require_once 'classes/postman.php';

$edb = new ExamsDB();
$exams = $edb->loadExams();

$jc = new JExamConnection();
$jc->login($login);
$html = $jc->exams_html($pin);
$jc->logout();

$p = new ExamsParser($html);
$updates = $p->getUpdates($exams);
$p->debugOutput($exams, $updates);
$edb->log($updates);
$edb->getStatus();

if ($updates) {
  $edb->storeExams($updates);

  $cl = new ClientDB();
  $clients = $cl->getClients();
  $cl->close();

  $pm = new Postman($mail_header);
  $pm->notify($clients, $updates);
}


$edb->close();


?>
</body></html>
