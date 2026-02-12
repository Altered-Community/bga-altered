<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_TikTok extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_86_R2',
      'asset'  => 'ALT_DUSTER_B_AX_86_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Tik-Tok"),
      'typeline' => clienttranslate("Character - Artist Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('HashtagDanceTillUDrop HashtagOzmaLoveLove'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST, ROBOT],
      'effectDesc' => clienttranslate('{H} #Each player# exhausts ({T}) a Permanent they control or a card in their Reserve.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' =>  FT::SEQ(
        FT::XOR(
          FT::ACTION(TARGET, [
            'targetType' => [PERMANENT],
            'targetPlayer' => ME,
            'isNotTapped' => true,
            'effect' => FT::SEQ(
              FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
            )
          ]),
          FT::ACTION(TARGET, [
            'targetType' => [SPELL, CHARACTER, PERMANENT],
            'targetPlayer' => ME,
            'isNotTapped' => true,
            'targetLocation' => [RESERVE],
            'effect' => FT::SEQ(
              FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
            )
          ])
        ),
        [
          'type' => NODE_XOR,
          'pId' => 'nextPlayer',
          'childs' => [
            FT::ACTION(TARGET, [
              'targetType' => [PERMANENT],
              'targetPlayer' => ME,
              'isNotTapped' => true,
              'effect' => FT::SEQ(
                FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
              )
            ]),
            FT::ACTION(TARGET, [
              'targetType' => [SPELL, CHARACTER, PERMANENT],
              'targetPlayer' => ME,
              'isNotTapped' => true,
              'targetLocation' => [RESERVE],
              'effect' => FT::SEQ(
                FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
              )
            ])
          ]
        ]
      )
    ];
  }
}
