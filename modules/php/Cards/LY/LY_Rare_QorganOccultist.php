<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_QorganOccultist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_YZ_106_R2',
      'asset'  => 'ALT_EOLE_B_YZ_106_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Qorgan Occultist"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('\"Be careful, the Nightare\'s darkness can taint any idea.\".'),
      'artist' => "Gamon Studio",
      'extension' => 'ROC',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless you discarded a card from your hand #or Reserve# this turn. (Not this Day.)'),
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['ocean'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'checkAbilityActivatedThisTurn:discardOrReserve',
        'effect' => 'OPPOSITE',
        'oppositeEffect' => FT::GAIN(ME, FLEETING),
      ]),
    ];
  }
}
