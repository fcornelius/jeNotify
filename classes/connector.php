<?php

require_once '../lib/unirest-php/src/Unirest.php';

class JExamConnection {

    private $je_uri     = "https://jexam.inf.tu-dresden.de/de.jexam.web.v4.5/spring/";
    private $je_start   = "welcome";
    private $je_login   = "j_acegi_security_check";
    private $je_results = "exams/results";
    private $je_logout  = "logout";
    private $header = '';

    public function login($login) {
      $start_req = Unirest\Request::get($this->je_uri . $this->je_start);

      $cookie = $start_req->headers['Set-Cookie'];
      $cookie = explode(';', $cookie)[0];
      $this->header = array('Cookie' => $cookie);

      $login_body = Unirest\Request\Body::form($login);
      $login_req  = Unirest\Request::post($this->je_uri . $this->je_login, $this->header, $login_body);
    }

    public function exams_html($pin) {
      $pin_body    = Unirest\Request\Body::form($pin);
      $results_req = Unirest\Request::post($this->je_uri . $this->je_results, $this->header, $pin_body);
      return $results_req->body;
    }

    public function logout() {
      $logout_req = Unirest\Request::get($this->je_uri . $this->je_logout, $this->header);
    }
}

?>
