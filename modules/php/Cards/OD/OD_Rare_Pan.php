<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Pan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_76_R2',
      'asset'  => 'ALT_CYCLONE_B_MU_76_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Pan"),
      'typeline' => clienttranslate("Character - Druid"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('He\'s definitely the black sheep around here!'),
      'artist' => "Ed Chee, S.yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [DRUID],
      'effectDesc' => clienttranslate('{H} <SABOTAGE>. If you discarded a card this way, create a <WOOLLYBACK> Animal token in the Companion Expedition of its owner. #You may have it gain <ASLEEP>.#'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest'],
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, []),
          FT::XOR(
            FT::SEQ(
              FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextTokenAsleep']),
              FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'MU_Common_Woollyback',
                'targetLocation' => [STORM_RIGHT],
                'targetPlayer' => 'owner',
              ]),
            ),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'MU_Common_Woollyback',
              'targetLocation' => [STORM_RIGHT],
              'targetPlayer' => 'owner',
            ]),
          )
        )
      ]),
    ];
  }
}
