<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_MothtoaSpring extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_78_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_78_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Moth to a Spring"),
      'typeline' => clienttranslate("Spell - Conjuration Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('A spring that will quench any thirst for magic.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION, MANEUVER],
      'effectDesc' => clienttranslate('Create a <MANA_MOTH> Illusion token in target Expedition.  Draw a card.'),
      'costHand' => 4,
      'costReserve' => 5,
      'effectPlayed' => FT::SEQ(
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
