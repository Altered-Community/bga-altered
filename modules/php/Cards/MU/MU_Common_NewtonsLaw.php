<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_NewtonsLaw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_99_C',
      'asset'  => 'ALT_DUSTER_B_MU_99_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Newton's Law"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('A truly stunning discovery…'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Create a <MANASEED> token in target opponent\'s Landmarks.  Then, send to Reserve target Character they control with Base Cost {3} or less. (Its Base Cost is the Reserve Cost if it\'s Fleeting, or the Hand Cost if not.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'targetPlayer' => OPPONENT,
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
        FT::ACTION(TARGET, [
          'targetPlayer' => OPPONENT,
          'maxBaseCost' => 3,
          'effect' => FT::DISCARD_TO_RESERVE()
        ])
      )
    ];
  }
}
