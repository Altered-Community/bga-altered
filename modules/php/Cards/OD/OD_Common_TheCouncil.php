<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_TheCouncil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_12_C',
      'asset' => 'ALT_CORE_B_OR_12_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'The Council',
      'typeline' => 'Character - Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'The idea of facing the Council is deterrent enough for most would-be criminals in Asgartha.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => 'The {j}, {h} and {r} triggers of Characters facing me don\'t activate.',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'blockingPower' => true
    ];
  }
}
