<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_MoonlightJellyfish extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_05_R2',
      'asset' => 'ALT_CORE_B_YZ_05_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Moonlight Jellyfish'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'Theoretically, transdifferentiation can go on indefinitely, effectively rendering the jellyfish biologically immortal... and squishy.'
      ),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate(
        '#When a Robot joins your Expeditions — You may sacrifice me to give it 2 boosts.#  When I\'m sacrificed, if I was not <FLEETING> — Put me in Reserve.'
      ),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'sacrificeAndNotFleetingGoToReserve' => true,
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCardAdded:robot',
          'output' => FT::SEQ_OPTIONAL(FT::ACTION(DISCARD, ['desc' => 'sacrifice', 'cardId' => ME]), FT::GAIN(EFFECT, BOOST, 2)),
        ],
        'InvokeToken' => [
          'condition' => 'isCardAdded:robot',
          'output' => FT::SEQ_OPTIONAL(FT::ACTION(DISCARD, ['desc' => 'sacrifice', 'cardId' => ME]), FT::GAIN(EFFECT, BOOST, 2)),
        ],
      ],
    ];
  }
}
