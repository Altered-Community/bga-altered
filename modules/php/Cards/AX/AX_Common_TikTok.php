<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TikTok extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_86_C',
      'asset'  => 'ALT_DUSTER_B_AX_86_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Tik-Tok"),
      'typeline' => clienttranslate("Character - Artist Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('HashtagDanceTillUDrop HashtagOzmaLoveLove'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST, ROBOT],
      'effectDesc' => clienttranslate('{H} Exhaust ({T}) a Permanent you control or a card in your Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::XOR(
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'targetPlayer' => ME,
          'effect' => FT::SEQ(
            FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
          )
        ]),
        FT::ACTION(TARGET, [
          'targetType' => TYPES,
          'targetPlayer' => ME,
          'targetLocation' => [RESERVE],
          'effect' => FT::SEQ(
            FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
          )
        ])
      )
    ];
  }
}
