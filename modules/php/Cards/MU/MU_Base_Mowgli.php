<?php
namespace ALT\Cards\MU;

class MU_Base_Mowgli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_20',
      'asset' => 'MU-14_Mowgli_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Mowgli'),
      'type' => EXPLORER,
      'subtype' => 'Ranger',
      'typeline' => 'Explorer Base - Ranger',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(''),

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
