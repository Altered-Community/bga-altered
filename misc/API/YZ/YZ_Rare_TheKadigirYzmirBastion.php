<?php
namespace ALT\Cards\YZ;

class YZ_Rare_TheKadigirYzmirBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_30_R1',
      'asset' => 'ALT_CORE_B_YZ_30_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Kadigir, Yzmir Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{T} : The next Spell you play this turn is free. If you play it from your hand, it loses [[Fleeting]].'
      ),
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}
