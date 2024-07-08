<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Flamel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_14_R2',
      'asset' => 'ALT_CORE_B_YZ_14_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Flamel'),
      'typeline' => clienttranslate('Character - Scholar'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'Rubedo is the final stage of alchemy, where one\'s substance is reborn like a phoenix before returning to the world.'
      ),
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [SCHOLAR],
      'effectDesc' => clienttranslate('{H} You may return a Spell from your Reserve to your hand.'),
      'supportDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(
        TARGET,
        [
          'targetLocation' => [RESERVE],
          'targetPlayer' => ME,
          'targetType' => [SPELL],
          'effect' => FT::RETURN_TO_HAND(),
        ],
        ['optional' => true]
      ),
      'supportIcon' => 'discard',
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1]],
      ],
    ];
  }
}
