<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Bait extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_81_R1',
      'asset'  => 'ALT_CYCLONE_B_YZ_81_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bait"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('They always say the grass is greener on the other side...'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  #Up to three# target token Characters defect. (They each join the Expedition facing theirs, changing controllers.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'onlyToken' => true,
          'upTo' => true,
          'n' => 3,
          'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'defect'])
        ])
      )
    ];
  }
}
