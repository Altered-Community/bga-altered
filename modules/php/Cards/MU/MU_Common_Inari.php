<?php
namespace ALT\Cards\MU;

class MU_Common_Inari extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '106',
      'asset' => 'MU-11-Inari-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Inari'),
      'typeline' => clienttranslate('Common - Divinity'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Divinity',

      'forest' => 3,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
