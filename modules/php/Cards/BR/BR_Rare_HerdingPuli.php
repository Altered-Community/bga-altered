<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_HerdingPuli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_106_R2',
      'asset'  => 'ALT_EOLE_B_MU_106_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Herding Puli"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} Create a <WOOLLYBACK> Animal token in the Expedition facing me. It gains #<ASLEEP>.#'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['forest'],
      'effectPlayed' => FT::SEQ(
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextTokenAsleep']),
        FT::ACTION(TARGET_EXPEDITION, [
          'players' => OPPONENT,
          'effect' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'MU_Common_Woollyback',
          ]),

        ]),
      )
    ];
  }
}
