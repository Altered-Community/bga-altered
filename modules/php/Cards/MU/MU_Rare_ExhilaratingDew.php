<?php
namespace ALT\Cards\MU;

class MU_Rare_ExhilaratingDew extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-49_Nurturing_Watering_Can_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Exhilarating Dew'),
      'type' => SPELL,
      'subtype' => '',
      'rarity' => RARITY_RARE,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
