<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Ogun extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_06_C',
      'asset' => 'ALT_CORE_B_AX_06_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Ogun',
      'type' => CHARACTER,
      'subtypes' => [ENGINEER, DEITY],
      'effectDesc' => '{J} Robots you control gain 1 boost$[BB].',
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllSubtype', 'args' => ['subType' => ROBOT]]),
      'flavorText' => "With every blow of his hammer, Ogun forges the Axiom\'s destiny.",
      'typeline' => 'Character - Engineer Deity',
      'artist' => 'Edward Cheekokseang',
    ];
  }
}
