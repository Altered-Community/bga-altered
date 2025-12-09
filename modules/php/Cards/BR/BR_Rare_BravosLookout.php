<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_BravosLookout extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_93_R1',
      'asset'  => 'ALT_DUSTER_B_BR_93_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bravos Lookout"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I think I\'ve found a good spot!"'),
      'artist' => "Christophe Young",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{R} I gain #2 boosts.#'),
      'supportDesc' => clienttranslate('#{D} : The next Character played from your hand this turn activates one of its {r} abilities.#'),
      'supportIcon' => 'discard',
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 4,
      'changedStats' => ['costReserve'],
      'effectReserve' => FT::GAIN(ME, BOOST, 2),
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'limit' => 1, 'effect' => RESERVE],
      ]),
    ];
  }
}
