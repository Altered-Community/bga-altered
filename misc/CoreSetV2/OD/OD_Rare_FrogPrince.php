<?php
namespace ALT\Cards\OD;

class OD_Rare_FrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_09_R1',
      'asset' => 'ALT_CORE_B_OR_09_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Frog Prince'),
      'typeline' => clienttranslate('Character - Bureaucrat Noble'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, NOBLE],
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['forest', 'water', 'costHand', 'costReserve'],
    ];
  }
}
