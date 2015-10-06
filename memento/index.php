<?php
  require 'class.php';

  $film1= new Dvd('Les Minions');//definition des film
  $film2= new Dvd('Mad max: fury road');
  $film3= new Dvd('test');
  $lecteur= new Lecteur();//definition du lecteur
  $lecteur->addDvd($film1);//ajout des films dans le lecteur
  $lecteur->addDvd($film2);
  $lecteur->lecture($film3,false);
  $lecteur->lecture($film1,false);//false pour reprendre depuis le debut
  $lecteur->lecture($film2,false);
  $lecteur->lecture($film1,true);//true pour reprendre la ou le film avait etait laissé
  $lecteur->lecture($film2,true);
  $lecteur->saveMinutage($film1);//forcé le save du minutage actuel du film pour forcer un retour a ce temps
  //dans le cas ou le temps defilerais vraiment
  $lecteur->lecture($film1,true);
  $lecteur->lecture($film1,true);
  $lecteur->lecture($film1,true);
  $lecteur->returnTo($film1); // retourner a la derniere position sauvegardée
  $lecteur->lecture($film1,true);
  $lecteur->lecture($film1,true);
