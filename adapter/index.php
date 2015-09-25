<?php
/*
Class mailer{ =>old
  public function send(){

  }
}

Class mailer{ =>new
  public function envoyer(){

  }
  public function valider(){

  }
}
*/
  require 'class.php';
  require 'adapter.php';

  $mailer= new MailerAdapter(new Mailer());

  $mailer->send();
