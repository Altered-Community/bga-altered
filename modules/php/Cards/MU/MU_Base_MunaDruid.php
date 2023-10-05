<?php
namespace ALT\Cards\MU;

class MU_Base_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-20_TasakaalMeshrider_RGB_01',
      'frameSize' => 3,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Muna Druid'),
      'type' => EXPLORER,
      'subtype' => 'Druid',
      'rarity' => RARITY_BASE,
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
