<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_GuidingOcelot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_107_C',
      'asset'  => 'ALT_EOLE_B_BR_107_C',
      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Guiding Ocelot"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Julien Carrasco",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain 1 boost.  When another Character joins your Expeditions — You may spend 1 of my boosts. If you do, it gains 1 boost.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::GAIN(ME, BOOST, 1),
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
