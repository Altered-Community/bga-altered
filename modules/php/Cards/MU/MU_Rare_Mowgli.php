<?php
namespace ALT\Cards\MU;

class MU_Rare_Mowgli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_2_28',
      'asset' => 'MU-14_Mowgli_RGB_02',
      'frameSize' => 3,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Mowgli'),
      'type' => EXPLORER,
      'subtype' => 'Ranger',
      'typeline' => 'Explorer Rare - Ranger',
      'rarity' => RARITY_RARE,
      'effectDesc' => clienttranslate(''),
      'echoDesc' => clienttranslate(
        '[G]{D} : The next Character you play this turn gains 1 boost. (Discard me from Reserve to activate this effect)[/G]'
      ),

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
