<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_RekaBarmaid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_89_C',
      'asset'  => 'ALT_DUSTER_B_LY_89_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Barmaid"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"It\'s happy hour all the time here!"'),
      'artist' => "Zero Wen",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST],
      'effectDesc' => clienttranslate('At Dusk — If I\'m <IN_CONTACT>, I gain 1 boost. (I\'m In Contact if another player\'s Expedition is in my region.)'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'BeforeDusk' => [
          'conditions' => ['isMe', 'isInContact'],
          'output' => FT::GAIN(ME, BOOST)
        ]
      ]
    ];
  }
}
