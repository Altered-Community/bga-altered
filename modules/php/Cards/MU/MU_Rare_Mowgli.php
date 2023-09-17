<?php
namespace ALT\Cards\MU;

class MU_Rare_Mowgli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-14_Mowgli_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Mowgli'),
      'type' => EXPLORER,
      'subtype' => 'Ranger',
      'rarity' => RARITY_RARE,
      'forest' => 2,
      'mountain' => 2,
      'water' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
