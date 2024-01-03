<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisSpy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_14_C',
      'asset' => 'ALT_CORE_B_OR_14_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Spy'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{H} $[SABOTAGE].'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
