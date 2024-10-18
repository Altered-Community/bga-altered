<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_TeijaNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_01_C',
      'asset' => 'ALT_CORE_B_MU_01_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Teija & Nauraa'),
      'type' => HERO,
      'thumbnail' => 0,
      'statData' => 12,
      'typeline' => clienttranslate('Muna Hero'),
      'effectDesc' => clienttranslate('The first Character you play each Afternoon gains 1 boost$<BB>.'),
      'flavorText' => clienttranslate('Nature must be nurtured to fully express its generosity.'),
      'artist' => 'Nestor Papatriantafyllou',

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectPassive' => [
        'ImmediateChooseAssignment' => [
          'conditions' => ['notUsed', 'isCardPlayed:character'],
          'output' => FT::SEQ(FT::GAIN(EFFECT, BOOST), ['action' => SPECIAL_EFFECT, 'args' => ['effect' => 'useCard']]),
        ],
      ],
    ];
  }
}
