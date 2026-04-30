<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_GuidingOcelot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_107_R2',
      'asset'  => 'ALT_EOLE_B_BR_107_R',
      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Guiding Ocelot"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Julien Carrasco",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain #2 boosts.#  When another Character joins your Expeditions — You may spend 1 boost #from a Character you control# to give it 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'ocean'],
      'effectHand' => FT::GAIN(ME, BOOST, 2),
      'effectPassive' => [
        'ChooseAssignment' => [
          'conditions' => ['isCardAddedAnyPlayer:character:::true', 'hasSameOwner'],
          'output' => FT::ACTION(TARGET,
            [
              'targetPlayer' => ME,
              'targetLocation' => STORMS,
              'targetType' => [CHARACTER],
              'upTo' => true,
              'effect' => FT::ACTION(SPEND, [
                'cardId' => TARGET,
                // TODO: EFFECT is *NOT* correct here, it will use the card that was targetted for spending the boost
                // instead of the new card.
                'effect' => FT::GAIN(EFFECT, BOOST)
              ]),
            ]
          ),
        ]
      ],
    ];
  }
}
