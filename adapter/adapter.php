<?php
  /**
   *
   */
  class MailerAdapter
  {
    public $mailer;

    public function __construct(Mailer $mailer)
    {
      $this->mailer=$mailer;
    }
    public function send(){
      if($this->mailer->valider()){
        $this->mailer->envoyer();
      }
    }
  }
