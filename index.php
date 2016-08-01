<?php

require_once '../lib/unirest-php/src/Unirest.php';
require_once 'config.php';
require_once 'connector.php';
require_once 'parser.php';


$jc = new JExamConnection();
$jc->login($login);
$html = $jc->exams_html($pin);

$p = new ExamsParser($html);
$p->getList();

// echo $html;
$jc->logout();



?>
