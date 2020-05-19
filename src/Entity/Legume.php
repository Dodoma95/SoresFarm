<?php

namespace App\Entity;

class Legume{

  public $name;
  public $price;
  public $origin;
  public $skill = [];

  public static $legumes=[];

  public function __construct($name,$price,$origin,$skill){
    $this->name = $name;
    $this->price = $price;
    $this->origin = $origin;
    $this->skill = $skill;
    self::$legumes[] = $this;
  }

  public static function CreerLegume(){
    $leg1 = New Legume("Courgette", 2, "Spain", [
      'weight' => 200,
      'nutritivValue' => 'Good for health',
      'color' => 'green'
    ]);
    $leg2 = New Legume("Haricot", 5, "Francia", [
      'weight' => 10,
      'nutritivValue' => 'Very good for health',
      'color' => 'green'
    ]);
    $leg3 = New Legume("Aubergine", 2, null, [
      'weight' => 200,
      'nutritivValue' => 'Good for health',
      'color' => 'violet'
    ]);
  }

  public static function getLegumebyName($name){
    foreach(self::$legumes as $legume){
      if (strtolower($legume->name) === $name){
        return $legume;
      }
    }
  }

}
