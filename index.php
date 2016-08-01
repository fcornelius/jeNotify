
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>

<?php

require_once 'config.php';
require_once 'connector.php';
require_once 'parser.php';
require_once 'db.php';
require_once 'examsdb.php';
require_once 'clientdb.php';
require_once 'postman.php';

$db = new ExamsDB();
$exams = $db->loadExams();

$jc = new JExamConnection();
$jc->login($login);
$html = $jc->exams_html($pin);
$jc->logout();

$p = new ExamsParser($html);
$updates = $p->getUpdates($exams);
$p->debugOutput($exams, $updates);

if ($updates) {
  $db->storeExams($updates);

}

?>
</body></html>
