<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_MiaPrimaBallerina extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_114_C',
      'asset'  => 'ALT_EOLE_B_LY_114_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Mia, Prima Ballerina"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The former Matriarch of the Kasirga clan leads the dance, however macabre it may be.'),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [ARTIST],
      'supportDesc' => clienttranslate('{D} : Target Character gains <FLEETING>. (Discard me from Reserve to do this.)'),
      'supportIcon' => 'discard',
      'forest' => 5,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectSupport' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'targetLocation' => [STORM_LEFT, STORM_RIGHT],
        'effect' => FT::GAIN(EFFECT, FLEETING),
      ]),
    ];
  }
}
