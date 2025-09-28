<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_OrdisSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_78_R2',
      'asset'  => 'ALT_CYCLONE_B_OR_78_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Ordis Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Cohesion and justice.'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Target Character gains <ASLEEP>.  • Target Character in Expedition or in Reserve loses all its boosts.  • Each Character in target Expedition gains 1 boost.'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        [
          'type' => NODE_OR,
          'args' => ['n' => 2],
          'pId' => 'source',
          'childs' => [
            FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ASLEEP)]),
            FT::ACTION(TARGET, ['targetLocation' => [STORM_LEFT, STORM_RIGHT, RESERVE], 'effect' => FT::LOOSE(EFFECT, BOOST, 99)]),
            FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllCharactersInExpedition'])])
          ]
        ]
      )
    ];
  }
}
