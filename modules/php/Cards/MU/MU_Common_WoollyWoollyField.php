<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_WoollyWoollyField extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_82_C',
      'asset'  => 'ALT_CYCLONE_B_MU_82_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Woolly Woolly Field"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Talk about wild and woolly!'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{T} : Create a <WOOLLYBACK> Animal token in target opponent\'s Companion Expedition. The next Character you play this turn gains 1 boost.'),
      'costHand' => 3,
      'costReserve' => 3,
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
