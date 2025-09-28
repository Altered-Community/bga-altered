<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Melusine extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_70_R1',
      'asset'  => 'ALT_CYCLONE_B_OR_70_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Melusine"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Every broken promise demands retribution.'),
      'artist' => "Zael",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} If I\'m in an Ascended Expedition, <SABOTAGE_LOW>. Otherwise, my Expedition <ASCENDS>.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 1,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isCardExpeditionAscended',
        'effect' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        'oppositeEffect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'expedition' => 'source'])
      ]),
    ];
  }
}
