<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_WoollyWoollyField extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_82_R2',
      'asset'  => 'ALT_CYCLONE_B_MU_82_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Woolly Woolly Field"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Talk about wild and woolly!'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{T} : Create a <WOOLLYBACK> Animal token in target opponent\'s Companion Expedition. The next Character you play this turn gains 1 boost.'),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand', 'costReserve'],
      'effectTap' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'MU_Common_Woollyback',
          'targetLocation' => [STORM_RIGHT],
          'targetPlayer' => OPPONENT,
        ]),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost'])
      )
    ];
  }
}
