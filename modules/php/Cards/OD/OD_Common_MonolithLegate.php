<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_MonolithLegate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_08_C',
      'asset' => 'ALT_CORE_B_OR_08_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Monolith Legate',
      'typeline' => 'Character - Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'Your document has expired. Needless to say, that\'s not his problem.',
      'artist' => 'Romain Kurdi',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => 'When my Expedition fails to move forward during Dusk — $<SABOTAGE> after Rest.',
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'myExpeditionHasNotMoved',
          'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AfterRestSabotage'])
        ],
      ]
    ];
  }
}
