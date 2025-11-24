<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_TechnologicalEncounter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_98_R2',
      'asset'  => 'ALT_DUSTER_B_AX_98_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Technological Encounter"),
      'typeline' => clienttranslate("Spell - Conjuration Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"The fruit of our research will lead our peoples to new heights."'),
      'artist' => "DOBA",
      'extension' => 'SDU',
      'subtypes'  => [CONJURATION, MANEUVER],
      'effectDesc' => clienttranslate('<COOLDOWN>.  Draw a card, then create a <MANASEED> token in your Landmarks.'),
      'costHand' => 4,
      'costReserve' => 2,
      'cooldown' => true,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(DRAW, ['players' => ME]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
      )
    ];
  }
}
