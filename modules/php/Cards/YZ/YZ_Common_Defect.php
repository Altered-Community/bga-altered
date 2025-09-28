<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Defect extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_77_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_77_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Defect"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Changing sides isn\'t always a matter of choice.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Target Character defects. (It joins the Expedition facing it, changing controllers. If it would move to your Reserve or any other personal zone, it goes to its owner\'s instead.)'),
      'costHand' => 7,
      'costReserve' => 7,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'defect'])])
      )
    ];
  }
}
