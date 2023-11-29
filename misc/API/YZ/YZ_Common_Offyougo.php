<?php
namespace ALT\Cards\YZ;

class YZ_Common_Offyougo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_21_C',
      'asset' => 'ALT_CORE_B_YZ_21_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Off you go!'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('Send to Reserve target Character with Hand Cost {3} or less.'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
