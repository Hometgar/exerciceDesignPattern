<?php
    class Lecteur{ //interface
        public $_lecture=[];
        public $inPlay;

        //ajouter un film a la liste de lecture
        function addDvd(Dvd $dvd){
          $dvdTitle = $dvd->getTitle();
          $this->_lecture[$dvdTitle]['dvd']=$dvd;
          if(!isset($this->_lecture[$dvdTitle]['memento'])){
            $this->_lecture[$dvdTitle]['memento'] = new Memento($dvd);
          }
          if($this->_lecture[$dvdTitle]['memento']->getLastMinute()>0){
              $this->_lecture[$dvdTitle]['dvd']->setMinutage($this->_lecture[$dvdTitle]['memento']->getLastMinute());
          }
        }

        //enregistrer le minutage courant du film sans le quitter
        function saveMinutage(Dvd $dvd){
            $this->_lecture[$dvd->getTitle()]['memento']->saveMinutage($dvd);
        }

        //lit le film passé en parametre, si le film passé est different du film actuellement en lecture (inPlay)
        //dans le cas ou le film passé en parametre est different du film en lecture alors enregistre le minutage du film en lecture dans le memento
        //et selon memento commence le film depuis le debut (!$memento) ou depuis le minutage contenue dans le memento de ce film
        //verifie aussi que le film a etait initialise dans le lecteur renvoie une erreur dans le cas contraire
        function lecture(Dvd $dvd,$memento){
          if(!isset($this->_lecture[$dvd->getTitle()]['dvd'])){
            echo 'merci de d\'abord initialiser le film <br>';
          }else{
            if(!isset($this->inPlay)){
              $this->inPlay=$dvd->getTitle();
              echo $this->inPlay.' minutage :'.$this->_lecture[$this->inPlay]['dvd']->getMinute().'<br>';
              $this->_lecture[$this->inPlay]['dvd']->setMinutage($this->_lecture[$this->inPlay]['dvd']->getMinute()+1);
            }elseif ($this->inPlay!=$dvd->getTitle()) {
              $this->_lecture[$this->inPlay]['memento']->saveMinutage($this->_lecture[$this->inPlay]['dvd']);
              if($memento){
                $this->_lecture[$dvd->getTitle()]['dvd']->setMinutage($this->_lecture[$dvd->getTitle()]['memento']->getLastMinute());
              }else{
                $this->_lecture[$dvd->getTitle()]['dvd']->setMinutage(0);
              }
              $this->inPlay=$dvd->getTitle();
              $actual = $this->_lecture[$this->inPlay]['dvd']->getMinute();
              echo $this->inPlay.' minutage :'.$actual.'<br>';
              $this->_lecture[$this->inPlay]['dvd']->setMinutage($this->_lecture[$this->inPlay]['dvd']->getMinute()+1);
            }else{
              echo 'film deja en lecture; minutage actuel:'.$this->_lecture[$this->inPlay]['dvd']->getMinute().'<br>';
              $this->_lecture[$this->inPlay]['dvd']->setMinutage($this->_lecture[$this->inPlay]['dvd']->getMinute()+1);
            }

          }
        }

        //permet de retourner a la valeur contenue dans le memento
        function returnTo(Dvd $dvd){
          $this->_lecture[$dvd->getTitle()]['dvd']->setMinutage($this->_lecture[$dvd->getTitle()]['memento']->getLastMinute());
          echo 'Vous etes revenue a la derniere position sauvegardée; reprise du film au minutage: '.$this->_lecture[$dvd->getTitle()]['dvd']->getMinute().'<br>';
          $this->_lecture[$dvd->getTitle()]['dvd']->setMinutage($this->_lecture[$dvd->getTitle()]['dvd']->getMinute()+1);
        }
    }

    class Dvd{
        private $_title;
        private $_minute;

        function __construct($title){
            $this->_title=$title;
            $this->_minute=0;
        }

        function setMinutage($minutage){
            $this->_minute=$minutage;
        }

        function getMinute(){
          return $this->_minute;
        }

        function getTitle(){
          return $this->_title;
        }
    }

    class Memento{
      private $_title;
      private $_minute;

      function __construct(Dvd $dvd){
        $this->_title=$dvd->getTitle();
      }

      function saveMinutage(Dvd $dvd){
        $this->_minute=$dvd->getMinute();
      }

      function getLastMinute(){
        return $this->_minute;
      }
    }
