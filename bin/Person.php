<?php

class Person
{

  const MAX_POSSIBLE_AGE = 150;

  private $firstName;
  private $lastName;
  private $age;

  private static $maxAge = 0;
  // не собирает сборщик мусора ( статические свойства )

  public static function getOldest(){

     return self::$maxAge;

  }

  public function __construct($firstName,$lastName,$age = null){

      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->setAge($age);

  }

  public function __destruct(){



  }

  public function __toString()
  {

    return $this->firstName . " " . $this->lastName . "\n";

  }

  public function __get($prop)
  {

    $getter = 'get'.\ucfirst($prop);

    if(\method_exists($this,$getter)){

      return $this->$getter();

    }else{

      echo "Cannot access property \n";

    }

  }

  public function __set($name,$value)
  {

    $setter = 'set'.\ucfirst($name);

    if(\method_exists($this,$setter)){

      $this->$setter($value);

    }

  }

  public function __isset($prop)
  {
    return isset($this->$prop);
  }


  public function __unset($prop)
  {
     unset($this->$prop);
  }

  public function jsonSerialize($value='')
  {
    return [
      'firstName'=>$this->firstName,
      'lastName'=>$this->lastName,
    ];
  }

  public function getFirstName(){

    return $this->firstName;

  }

  public function setFirstName($name){

     $this->firstName = $name;

  }

  public function getLastName(){

    return $this->lastName;

  }

  public function setLastName($name){

     $this->lastName = $name;

  }

  public function getAge(){

      return $this->age;

  }

  public function setAge($age){

      if(self::MAX_POSSIBLE_AGE < $age){

         echo sprintf("Impossible age %d",$age) ."\n";
         return;

      }

       $this->age = $age;

      if($age > self::$maxAge){

          self::$maxAge = $age;

      }

  }

}
