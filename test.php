<?php

class App 
{
     public static $instance;
     private $guerriers = [];

     public static function getInstance ()
     {
          if (self::$instance == null) self::$instance = new self();
          return self::$instance;
     }

     private function getValid (): bool
     {
          return true;
     }

     public function isValid ()
     {
          if ($this->getValid()) {
               echo 'Bonjour le monde';
          }
          else echo 'Bonsoir le monde';
     }

     public function collection ()
     {
          
     }

     public function addGuerrier (Guerrier $guerrier): void
     {
          $this->guerriers[] = $guerrier;
     }

     public function getGuerrier (): ?array
     {
          return $this->guerriers;
     }

     public function newGuerrier (int $id): Guerrier
     {
          return $this->guerriers[$id];
     }
}


class Guerrier 
{
     private int $numero = 1;
     private string $nom;
     private string $prenom;

     public function __construct (?int $numero = null, string $nom, string $prenom)
     {
          $this->numero = $numero ?? $this->numero;
          $this->nom = $nom;
          $this->prenom = $prenom;
     }
}

$guerrier_1 = new Guerrier (2, 'San Goku', 'Sayien');
$guerrier_2 = new Guerrier (3, 'Vegeta', 'Sayien');
App::getInstance()->addGuerrier($guerrier_1);
App::getInstance()->addGuerrier($guerrier_2);
echo "Voici les guerriers dans son ensemble \n";
var_dump(App::getInstance()->getGuerrier());
echo "-------------------------------------\n";
var_dump(App::getInstance()->newGuerrier(0));

?>