<?php
  require 'interface.php';

  class Director {

    public function build(BillBuilderInterface $builder,$data){
      $builder->scane();
      foreach($data as $product){
        $builder->addProduct($product);
      }
      return $builder->getBill();
    }
  }

  class CarrefourBillBuilder implements BillBuilderInterface{

    private $bill;

    public function __construct(){
      $this->bill=$this->createBill();
    }

    public function createBill(){
      return new Bill();
    }

    public function scane(){
      echo "debut du scan <br>";
    }

    public function addProduct(Product $product){
      $this->bill->setParts($product);
    }

    public function getBill(){
      $total=0;
      $render ='Name                     | HT-Price  |  TTC<br>';
      $parts=$this->bill->getParts();
      foreach($parts as $product){
        $render.=$product->name.'                |'.$product->price.'&euro; | '.$product->price*(1+$product->tva).'<br>
        ______________________________________<br>';
        $total+=$product->price*(1+$product->tva);
      }
      $render.='                    Total:'.$total;

      return $render;
    }
  }

  class Product{
    public $name;
    public $price;
    public $tva;

    public function __construct($name,$price,$tva){
      $this->name=$name;
      $this->price=$price;
      $this->tva=$tva;
    }
  }

  class Bill{
    private $parts= array();

    public function setParts(Product $product){
      $this->parts[]=$product;
    }

    public function getParts(){
      return $this->parts;
    }
  }
