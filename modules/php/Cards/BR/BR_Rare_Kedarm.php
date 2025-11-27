<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Kedarm extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_89_R1',
      'asset'  => 'ALT_DUSTER_B_BR_89_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Kedarm"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('One of the many amazing Chimaeras that inhabit the Sea of Tumult.'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('#When I go to Reserve from the Expedition zone — You may return another target Character from your Reserve to your hand.#'),
      'supportDesc' => clienttranslate('{D} : The next Character played from your hand this turn activates one of its {r} abilities.'),
      'supportIcon' => 'discard',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'effect' => RESERVE],
      ]),
      'effectPassive' => [
        'LeaveExpedition' => [
          'condition' => 'isToReserve',
          'output' => FT::ACTION(
            TARGET,
            [
              'targetLocation' => [RESERVE],
              'targetPlayer' => ME,
              'targetType' => [CHARACTER],
              'excludeSelf' => true,
              'effect' => FT::RETURN_TO_HAND(),
            ],
            ['optional' => true]
          ),
        ],
      ],
    ];
  }
}
