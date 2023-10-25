<?php
namespace ALT\Helpers;

use ALT\Core\Globals;

// Conditions
abstract class Conditions
{
  public static function isFirstPlayer($card, $event)
  {
    return $card->getPId() == Globals::getFirstPlayer();
  }
}
