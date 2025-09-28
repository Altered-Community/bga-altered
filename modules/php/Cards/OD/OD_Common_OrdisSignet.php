<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OrdisSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_78_C',
      'asset'  => 'ALT_CYCLONE_B_OR_78_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Ordis Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Cohesion and justice.'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('Choose one:  • Target Character gains <ASLEEP>.  • Target Character in Expedition or in Reserve loses all its boosts.  • Each Character in target Expedition gains 1 boost.'),
      'costHand' => 2,
      'costReserve' => 4,
      'effectPlayed' => FT::XOR(
        FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ASLEEP)]),
        FT::ACTION(TARGET, ['targetLocation' => [STORM_LEFT, STORM_RIGHT, RESERVE], 'effect' => FT::LOOSE(EFFECT, BOOST, 99)]),
        FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllCharactersInExpedition'])])
      )
    ];
  }
}
