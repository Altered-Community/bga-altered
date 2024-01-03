<?php

namespace ALT\Cards\AX;

class AX_Common_FoundryEngineer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_05_C',
      'asset' => 'ALT_CORE_B_AX_05_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Foundry Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{R} The next Permanent you play this Afternoon costs {1} less.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,

      'effectReserve' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1, 'permanent' => true]],
      ],
      'flavorText' => clienttranslate('Behind every Axiom masterwork, there are Foundry Engineers.'),
      'typeline' => clienttranslate('Character - Engineer'),
    ];
  }
}
