<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_TimeOut extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_95_R1',
      'asset'  => 'ALT_DUSTER_B_YZ_95_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Time Out!"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Time to switch things up a bit.'),
      'artist' => "Gamon Studio",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('Send to Reserve target Character with Base Cost {4} or less, then exhaust it ({T}). (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)  Then, I gain <FLEETING> #unless there are two or more exhausted cards in Reserve.#'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'maxBaseCost' => 4,
          'effect' => FT::SEQ(
            FT::DISCARD_TO_RESERVE(),
            FT::ACTION(EXHAUST, [])
          )
        ]),
        FT::ACTION(CHECK_CONDITION, ['condition' => 'hasXExhaustedReserve:1:LTE', 'effect' => FT::GAIN(ME, FLEETING)])
      )
    ];
  }
}
