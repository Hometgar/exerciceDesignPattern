<?php
  require 'class.php';

  $moi=new Utilisateur('moi');
  $mur=new Mur('blanc');

  $postit1=$moi->attachPostit('balbalbla',$mur);
  $moi->detachPostit($postit1);
