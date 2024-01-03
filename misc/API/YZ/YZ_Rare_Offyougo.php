<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Offyougo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_21_R1',
      'asset' => 'ALT_CORE_B_YZ_21_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Off you go!'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('Send to Reserve target Character with Hand Cost {5} or less.'),
      'costHand' => 3,
      'costReserve' => 4,
    ];
  }
}
