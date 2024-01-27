<?php

namespace ALT\Cards\OD;

class OD_Common_MonolithArchivist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_10_C',
      'asset' => 'ALT_CORE_B_OR_10_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Monolith Archivist',
      'typeline' => 'Character - Bureaucrat',
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => '$[DEFENDER].',
      'flavorText' => '"The form has been filled out incorrectly. Please make a new appointment tomorrow."',
      'artist' => 'Atanas Lozanski',

      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'defender' => true,
    ];
  }
}
