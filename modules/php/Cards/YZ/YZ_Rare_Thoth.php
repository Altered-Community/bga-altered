<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Thoth extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_22_R2',
      'asset' => 'ALT_CORE_B_OR_22_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Thoth',
      'typeline' => 'Character - Deity Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => '"The pen is mightier than the sword."',
      'artist' => 'Christophe Young',
      'subtypes' => [DEITY, BUREAUCRAT],
      'effectDesc' =>
      'When my Expedition fails to move forward during Dusk — Create #two# <ORDIS_RECRUIT> Soldier tokens in target Expedition after Rest.',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'myExpeditionHasNotMoved',
          'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AfterRest2OrdisRecruit'])
        ]
      ]
    ];
  }
}
