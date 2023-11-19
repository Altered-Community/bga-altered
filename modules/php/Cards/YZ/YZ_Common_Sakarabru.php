<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Sakarabru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '182',
      'asset' => 'YZ-18-SakarMoonhealer-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Sakarabru'),
      'typeline' => clienttranslate('Common - Divinity'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Divinity',

      'effectDesc' => clienttranslate('{M} The Expedition opposing me moves one step back.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 7,
      'costReserve' => 7,
      'effectHand' => FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'expedition' => EFFECT, 'pId' => OPPONENT])
    ];
  }
}
