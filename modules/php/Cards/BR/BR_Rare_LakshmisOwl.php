<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_LakshmisOwl extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_119_R2',
      'asset'  => 'ALT_EOLE_B_LY_119_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Lakshmi's Owl"),
      'typeline' => clienttranslate("Character - Animal Spirit"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL, SPIRIT],
      'effectDesc' => clienttranslate('When #a Character gains 1 or more boosts# — If I have no boosts, #I gain 1 boost.#'),
      'supportDesc' => clienttranslate('#{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}.#'),
      'supportIcon' => 'discard',
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 0,
      //VTO support
      'costHand' => 1,
      'costReserve' => 1,
      'effectPassive' => [
        'Gain' => [
          [
            'conditions' => ['isGain:boost', 'hasNoBoost'],
            'output' => FT::GAIN(ME, BOOST),
          ],
        ],
      ],
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterCostReduction1']),
    ];
  }
}
