<?php
namespace ALT\Cards\YZ;

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
