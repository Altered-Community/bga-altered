<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Pan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_76_C',
      'asset'  => 'ALT_CYCLONE_B_MU_76_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Pan"),
      'typeline' => clienttranslate("Character - Druid"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('He\'s definitely the black sheep around here!'),
      'artist' => "Ed Chee, S.yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [DRUID],
      'effectDesc' => clienttranslate('{H} <SABOTAGE>. If you discarded a card this way, create a <WOOLLYBACK> Animal token in the Companion Expedition of its owner. (Sabotage means to discard up to one card from any Reserve.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, []),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'MU_Common_Woollyback',
            'targetLocation' => [STORM_RIGHT],
            'targetPlayer' => 'owner',
          ]),
        )
      ]),
    ];
  }
}
