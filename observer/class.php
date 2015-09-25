<?php
  class Utilisateur{
      private $nom;
      private $_asAttach=array();

      public function __construct($nom){
        $this->nom=$nom;
      }

      public function attachPostit($postit,Mur $mur){
        return $this->_asAttach[]=new Postite($postit,$this->nom,$mur);
      }

      public function detachPostit($postit){
        $key=array_search($postit,$this->_asAttach,true);
        $this->_asAttach[$key]->mur->detach($this->_asAttach[$key]);
      }
  }

  class Postite implements \SplObserver{
    private $_info;
    private $_owner;
    public $mur;
    public $state;

    public function __construct($info,$owner,$mur){
      $this->_info=$info;
      $this->_owner=$owner;
      $this->mur=$mur;
      $this->mur->attach($this);
    }

    public function getInfos(){
      return $this->_info;
    }

    public function update(\SplSubject $mur){
      if($this->state){
        mail('mikeyredon@hotmail.fr','Ajout de post-it',$this->_owner.' a mis une post-it au mur qui dit:'.$this->getInfos().', sur le mur '.$mur->couleur);
      }else{
        mail('mikeyredon@hotmail.fr','Retr&eacut; de post-it',$this->_owner.' a horriblement arracher le post-it sur lequel &eacute;tait &eacute;crit :'.$this->getInfos().' , du mur qui est '.$mur->couleur
);
      }
    }
  }

  class Mur implements \SplSubject {
    private $_Postit= array();
    public $couleur;

    public function __construct($couleur){
      $this->couleur=$couleur;
    }
    public function attach(\SplObserver $postit) {
        $this->_Postit[]=$postit;
        $postit->state=true;
        $this->notify();
    }

    public function detach(\SplObserver $postit) {
      $key = array_search($postit, $this->_Postit, true);
      if (false !== $key) {
        $postit->state=false;
        $this->notify();
        unset($this->_Postit[$key]);
      }
    }

    public function notify() {
        foreach($this->_Postit as $postit){
          $postit->update($this);
        }
    }
  }
