<?php

class Postman {

  private $header;

  public function __construct($header) {
    $this->header  = "From: ". $header['from'] ."\n";
    $this->header .= "Reply-To: ". $header['reply-to'] ."\n";
    $this->header .= "Content-Type:text/html;charset=utf-8\n";
  }

  public function notify($clients, $updates) {
    $first = array_values($updates)[0];
    $subject = "Ergebnisse für ". $first ." jetzt online!";
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
    $msg = "Hooray!<br>Die Ergebnisse für folgende Prüfungen sind jetzt in jExam abrufbar:<br><br>";
    $msg .= "<ul>";

    foreach ($updates as $id => $name) {
      $msg .= "<li>". $name ." (Modul ". $id .")</li>";
    }

    $msg .= "</ul><br><br>";
    $msg .= "<a href='https://jexam.inf.tu-dresden.de/de.jexam.web.v4.5/spring/exams/results'>";
    $msg .= "Hier gelangst du zu den Ergebnissen</a><br>";
    $msg .= "<hr>". date('d.m.Y H:i:s');

    echo "<br><br>";
    foreach ($clients as $email) {
      mail($email, $subject, $msg, $this->header);
      // echo $email ."<br>". $subject ."<br>". $msg ."<br>". $this->header ."<br>";
    }
  }


}


 ?>
