
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


echo "<br><br>parsed:<br>";
$p = new ExamsParser($html);
$updates = $p->getUpdates($exams);

$db->storeExams($updates);

echo "<br><br>exams:<br>";
foreach ($exams as $key => $value) {
  echo "-". $key . "_". $value . "-<br>";
}

echo "<br>updates: <br>";
foreach ($updates as $key => $value) {
  echo "-". $key . "_". $value . "-<br>";
}


// echo $html;
$jc->logout();









?>
</body></html>
