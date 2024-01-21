<?php
namespace ALT\Cards\LY;

class LY_Rare_TheKadigirYzmirBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_30_R2',
      'asset' => 'ALT_CORE_B_YZ_30_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'The Kadigir, Yzmir Bastion',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
        "What dark, phantasmagorical secrets hide within Asgartha\'s College of Magic? Only madmen and the Yzmirs know for sure...",
      'artist' => 'MISSING ARTIST',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{T} : The next Spell you play this turn is free.',
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}
