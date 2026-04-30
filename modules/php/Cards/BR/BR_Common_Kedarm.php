<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_Kedarm extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_89_C',
      'asset'  => 'ALT_DUSTER_B_BR_89_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Kedarm"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('One of the many amazing Chimaeras that inhabit the Sea of Tumult.'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [ANIMAL],
      'supportDesc' => clienttranslate('{D} : The next Character played from your hand this turn activates one of its {r} abilities.'),
      'supportIcon' => 'discard',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'limit' => 1, 'effect' => RESERVE],
      ]),
    ];
  }
}
