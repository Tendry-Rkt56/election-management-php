<?php

namespace Config;


class Routing 
{

     private static $_instance;

     public function get(): self
     {
          if (self::$_instance == null) self::$_instance = new self();
          return self::$_instance;
     }

}