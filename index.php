
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>

<?php
require_once '../lib/unirest-php/src/Unirest.php';
require_once 'config.php';
require_once 'connector.php';
require_once 'parser.php';
require_once 'db.php';

$db = new ExamsDB();
$exams = $db->loadExams();

$jc = new JExamConnection();
$jc->login($login);
$html = $jc->exams_html($pin);

$p = new ExamsParser($html);
$p->getList();

// echo $html;
$jc->logout();


foreach ($exams as $key => $value) {
  echo $key . " - ". $value . "<br>";
}






?>
</body></html>
