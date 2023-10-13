<?php
namespace ALT\Cards\MU;

class MU_Base_Inari extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_22',
      'asset' => 'MU-06_Inari_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Inari'),
      'type' => EXPLORER,
      'subtype' => 'Divinity',
      'typeline' => 'Explorer Base - Divinity',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(''),

      'forest' => 3,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
