<?php
namespace ALT\Cards\OD;

class OD_Rare_RobinHood extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_21_R1',
      'asset' => 'ALT_CORE_B_OR_21_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Robin Hood'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('#Cards# your opponents play cost {1} more.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
