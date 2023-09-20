<?php
namespace ALT\Cards\MU;

class MU_Base_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-36_Sneezer_Shroom_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Sneezer Shroom'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'rarity' => RARITY_BASE,
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
