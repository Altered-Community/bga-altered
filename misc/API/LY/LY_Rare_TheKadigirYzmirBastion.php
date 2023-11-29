<?php
namespace ALT\Cards\LY;

class LY_Rare_TheKadigirYzmirBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_30_R2',
      'asset' => 'ALT_CORE_B_YZ_30_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Kadigir, Yzmir Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('{T} : The next Spell you play this turn is free.'),
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}
