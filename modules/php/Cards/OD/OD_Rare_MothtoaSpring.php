<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_MothtoaSpring extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_78_R2',
      'asset'  => 'ALT_CYCLONE_B_YZ_78_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Moth to a Spring"),
      'typeline' => clienttranslate("Spell - Conjuration Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('A spring that will quench any thirst for magic.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION, MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Create #two# <MANA_MOTH> Illusion tokens, distributed among any Expeditions.  Draw a card.'),
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costHand'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => STORMS,
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => STORMS,
        ]),
        FT::ACTION(DRAW, ['players' => ME])
      )
    ];
  }
}
