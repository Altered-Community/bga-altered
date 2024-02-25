<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_TheKadigirYzmirBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_30_C',
      'asset' => 'ALT_CORE_B_YZ_30_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'The Kadigir, Yzmir Bastion',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
      'What dark, phantasmagorical secrets hide within Asgartha\'s College of Magic? Only madmen and the Yzmirs know for sure...',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{T} : The next Spell you play this turn is free.',
      'costHand' => 8,
      'costReserve' => 8,
      'effectTap' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextSpellIsFree'])
    ];
  }
}
