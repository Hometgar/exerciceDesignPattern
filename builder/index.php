<?php
  include 'class.php';

  $data=[new Product('choux',1.2,.055),new Product('hamburger',2.5,.055),new Product('voiture',1200,.199)];

  $director=new Director();
  $bill=new CarrefourBillBuilder();

  echo $director->build($bill,$data);
