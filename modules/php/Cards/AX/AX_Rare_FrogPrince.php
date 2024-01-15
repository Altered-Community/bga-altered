<?php

namespace ALT\Cards\AX;

class AX_Rare_FrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_09_R2',
      'asset' => 'ALT_CORE_B_OR_09_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Frog Prince'),
      'typeline' => clienttranslate('Character - Bureaucrat Noble'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, NOBLE],
      'supportDesc' => clienttranslate(
        '#{D} : The next Permanent you play this turn costs {1} less.# (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1]],
      ],
    ];
  }
}
