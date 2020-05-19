<?php

namespace App\Entity;

class Fruit{

  public $name;
  public $price;
  public $origin;
  public $skill = [];

  public static $fruits=[];

  public function __construct($name,$price,$origin,$skill){
    $this->name = $name;
    $this->price = $price;
    $this->origin = $origin;
    $this->skill = $skill;
    self::$fruits[] = $this;
  }

  public static function CreerFruit(){
    $fr1 = New Fruit("Fruit de la passion", 2, "Réunion", [
      'weight' => 15,
      'nutritivValue' => 'Good for sexuality',
      'color' => 'Orange'
    ]);
    $fr2 = New Fruit("Grenade", 5, "Madagacar", [
      'weight' => 50,
      'nutritivValue' => 'Miammmm',
      'color' => 'Brown'
    ]);
    $fr3 = New Fruit("Kiwi", 2, null, [
      'weight' => 12,
      'nutritivValue' => 'Good for health',
      'color' => 'Green'
    ]);
  }

  public static function getFruitbyName($name){
    foreach(self::$fruits as $fruit){
      if (strtolower($fruit->name) === $name){
        return $fruit;
      }
    }
  }

}
