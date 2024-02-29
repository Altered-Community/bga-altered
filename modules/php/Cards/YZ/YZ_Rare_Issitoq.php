<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Issitoq extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_19_R2',
      'asset' => 'ALT_CORE_B_OR_19_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Issitoq',
      'typeline' => 'Character - Deity Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'No one can escape their gaze.',
      'artist' => 'Atanas Lozanski',
      'subtypes' => [DEITY, BUREAUCRAT],
      'effectDesc' => 'Your other Expedition and the Expedition facing it can\'t move forward.',
      'supportDesc' => '{D} : Draw a card. (Discard me from Reserve to do this.)',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 6,
      'costReserve' => 6,
      'supportIcon' => 'discard',
      'effectSupport' => FT::ACTION(DRAW, ['players' => ME]),
      'oppositeDefender' => true,
    ];
  }
}
