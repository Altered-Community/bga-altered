<?php
namespace ALT\Cards\MU;

class MU_Common_Inari extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '106',
      'asset' => 'MU-06_Inari_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Inari'),
      'type' => CHARACTER,
      'subtype' => 'Divinity',
      'typeline' => 'Common - Divinity',
      'rarity' => RARITY_COMMON,

      'forest' => 3,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
