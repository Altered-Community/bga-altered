<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_HopomyThumb extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_107_C',
      'asset'  => 'ALT_EOLE_B_AX_107_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Hop-o'-my-Thumb"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{R} You may put a card from your hand in Reserve to create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectReserve' => FT::SEQ_OPTIONAL(
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetPlayer' => ME,
          'upTo' => true,
          'targetLocation' => [HAND],
          'effect' => FT::SEQ(
            FT::DISCARD_TO_RESERVE(),
            FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
          ),
        ]),
      ),
    ];
  }
}
