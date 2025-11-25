<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosCloudhog extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_91_C',
      'asset'  => 'ALT_DUSTER_B_BR_91_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Bravos Cloudhog"),
      'typeline' => clienttranslate("Character - Adventurer Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Ladies and gentlemen, you are about to experience some turbulence."'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER, ROGUE],
      'effectDesc' => clienttranslate('{R} <SABOTAGE>. If you discarded a Character this way, I gain 1 boost.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 4,
      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
      'effectPassive' => [
        'Discard' => [
          'conditions' => ['isMe', 'isSource', 'isDiscarded:reserve:discard:character'],
          'output' => FT::GAIN(ME, BOOST)
        ]
      ]
    ];
  }
}
