<?php
namespace ALT\Cards\OD;

class OD_Rare_TheFrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_09_R1',
      'asset' => 'ALT_CORE_B_OR_09_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Frog Prince'),
      'typeline' => clienttranslate('Character - Bureaucrate Noble'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, NOBLE],
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
