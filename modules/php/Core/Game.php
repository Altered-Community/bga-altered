<?php
namespace ALT\Core;
use alteredpreprod;

/*
 * Game: a wrapper over table object to allow more generic modules
 */
class Game
{
  public static function get()
  {
    return alteredpreprod::get();
  }
}
