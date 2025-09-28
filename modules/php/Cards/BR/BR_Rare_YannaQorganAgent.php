<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_YannaQorganAgent extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_75_R2',
      'asset'  => 'ALT_CYCLONE_B_OR_75_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Yanna, Qorgan Agent"),
      'typeline' => clienttranslate("Character - Bureaucrat Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Spies from the Qorgan infiltrate the Factions and steal their secrets.'),
      'artist' => "Ba Vo",
      'extension' => 'SO',
      'subtypes'  => [BUREAUCRAT, MAGE],
      'effectDesc' => clienttranslate('{J} You may have target Character gain <ASLEEP>. #If it\'s facing me, <SABOTAGE>.#'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(TARGET, [
        'upTo' => true,
        'effect' => FT::GAIN(EFFECT, ASLEEP)
      ]),
      'effectPassive' => [
        'Gain' => [
          'conditions' => ['isSource', 'isFacingSource'],
          'output' => FT::SABOTAGE()
        ]
      ]
    ];
  }
}
