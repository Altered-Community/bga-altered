<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_HerdingPuli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_106_C',
      'asset'  => 'ALT_EOLE_B_MU_106_C',
      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Herding Puli"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Come on, Bobble, watch over them. Bring them to daddy!"'),
      'artist' => "Victor Canton",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} Create a <WOOLLYBACK> Animal token in the Expedition facing me. It gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextTokenAnchored']),
        FT::ACTION(INVOKE_TOKEN, [
          'targetPlayer' => OPPONENT,
          'targetLocation' => ['source'],
          'tokenType' => 'MU_Common_Woollyback',
        ]),
      )
    ];
  }
}
