<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_JoiningFates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_81_C',
      'asset'  => 'ALT_CYCLONE_B_MU_81_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Joining Fates"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Be united in the Musubi."'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('<FLEETING>.  You may immediately play a Character for {7} less in your Companion Expedition. It gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
      'costHand' => 7,
      'costReserve' => 7,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::SEQ_OPTIONAL(
          [
            'action' => SPECIAL_EFFECT,
            'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 7, 'permanent' => false]],
          ],
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterAnchored']),
          FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [CHARACTER], 'actions' => ['play'], 'forcedLocation' => STORM_RIGHT])
        )

      )
    ];
  }
}
