<?php

namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_HopomyThumb extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_107_R2',
      'asset' => 'ALT_EOLE_B_AX_107_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate("Hop-o'-my-Thumb"),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("It's not easy to lead the way…"),
      'artist' => 'Zero Wen',
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('#{H}# You may put a card from your hand in Reserve to create an <AEROLITH> token in your Landmarks.'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasCardsInHand',
        'effect' => FT::SEQ_OPTIONAL(
          FT::ACTION(TARGET, [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetPlayer' => ME,
            'targetLocation' => [HAND],
            'effect' => FT::DISCARD_TO_RESERVE(),
          ]),
          FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
        ),
      ]),
    ];
  }
}
