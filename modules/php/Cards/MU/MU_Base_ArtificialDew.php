<?php
namespace ALT\Cards\MU;

class MU_Base_ArtificialDew extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-49_Nurturing_Watering_Can_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Artificial Dew'),
      'type' => SPELL,
      'subtype' => '',
      'rarity' => RARITY_BASE,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
