<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

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
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'effectDesc' => clienttranslate('{M} $[SABOTAGE].'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}
