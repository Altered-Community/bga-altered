<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_TeamMascot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_96_C',
      'asset'  => 'ALT_DUSTER_B_YZ_96_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Team Mascot"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('She gets the substitutes fired up so they\'re ready to take the field.'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST],
      'effectDesc' => clienttranslate('{J} If there\'s an exhausted card in Reserve, I gain 1 boost.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasXExhaustedReserve:1', 'effect' => FT::GAIN(ME, BOOST)])
    ];
  }
}
