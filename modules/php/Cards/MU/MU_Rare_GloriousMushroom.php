<?php
namespace ALT\Cards\MU;

class MU_Rare_GloriousMushroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-36_Sneezer_Shroom_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Glorious Mushroom'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'rarity' => RARITY_RARE,
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
