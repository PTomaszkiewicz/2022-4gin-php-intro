<?php
// Źródło przykładu: https://stackoverflow.com/questions/15960729/abstract-class-vs-interface 

// Tworzymy abstract Mammal (Ssak)
abstract class Mammal {
      protected $age_;
      // Poniżej są funkcje, które moim zdaniem mają wszystkie ssaki, w tym ludzie.
      abstract public function setAge($age);
      abstract public function getAge();
      abstract public function eat($food);
}

// Tworzymy klasę Person (człowiek)
class Person extends Mammal {
      protected $job_; // właściwość człowieka
      public function setAge($age){
        $this->age_ = $age;
      }

      public function getAge(){
        return $this->age_;
      }

      public function eat($food){
        echo 'I eat ' ,$food ,'today';
      }

      //People only attribute
      public function setJob($job){
         $this->job_ = $job;
      }
      public function getJob(){
         echo 'My job is ' , $this->job_;
      }
}

// Teraz osoba chce latać, ale zazwyczaj nie jest w stanie tego robić.
// Implementujemy interfejs Plane
interface Plane{
  public function Fly(); 
}

// oraz interfejs Gun
interface Gun{
  public function shoot();
}

// Tworzymy klasę EquippedPerson dla tych, którzy będą wyposazeni w samolot i pistolet)
class EquippedPerson extends Mammal implements Plane,Gun{
      protected $job_; 
      public function setAge($age){
        $this->age_ = $age;
      }
      public function getAge(){
        return $this->age_;
      }
      public function eat($food){
        echo 'I eat ' ,$food ,' today'."\n";
      }
      //Only a person has this feature.
      public function setJob($job){
         $this->job_ = $job;
      }
      public function getJob(){
         echo 'My job is ' , $this->job_, "\n";
      }

      //-----------------------------------------
      //below implementations from interfaces function. (features that humans do not have).
      //Person implements from other class
      public function fly(){
        echo 'I use plane, so I can fly'."\n";
      }
      public function shoot(){
        echo 'I use gun, so I can shoot'."\n";
      }
}

$People = new Person();
$EquippedPeople = new EquippedPerson();

print_r( get_class_methods('Person') );
print_r( get_class_methods('EquippedPerson') );


$EquippedPeople->setAge(24);
echo $EquippedPeople->getAge()."\n";
$EquippedPeople->eat('egg');
$EquippedPeople->setJob('PHP devepop');
echo $EquippedPeople->getJob()."\n";

$EquippedPeople->fly();
$EquippedPeople->shoot();
?>