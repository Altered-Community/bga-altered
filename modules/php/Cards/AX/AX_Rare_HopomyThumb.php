<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_HopomyThumb extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_107_R1',
      'asset'  => 'ALT_EOLE_B_AX_107_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Hop-o'-my-Thumb"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('#{H}# You may put a card from your hand in Reserve to create an <AEROLITH> token in your Landmarks.'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'changedStats' => ['ocean', 'costReserve'],
      'effectHand' =>
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
    ];
  }
}
