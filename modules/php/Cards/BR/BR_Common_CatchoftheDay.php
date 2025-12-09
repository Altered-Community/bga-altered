<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_CatchoftheDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_100_C',
      'asset'  => 'ALT_DUSTER_B_BR_100_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Catch of the Day"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('There\'s no slipping through the net this time.'),
      'artist' => "DOBA",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('Return target Character or Permanent controlled by another player to its owner\'s hand.  Then, create a <MANASEED> token in that player\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'costHand' => 2,
      'costReserve' => 4,
      'effectPlayed' =>
      FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, PERMANENT],
        'targetPlayer' => OPPONENT,
        'effect' => FT::SEQ(
          FT::RETURN_TO_HAND(),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Manaseed',
            'targetPlayer' => 'owner',
            'targetLocation' => ['discardedSource'],
            'forcedLocation' => LANDMARK
          ]),
        )
      ]),

    ];
  }
}
