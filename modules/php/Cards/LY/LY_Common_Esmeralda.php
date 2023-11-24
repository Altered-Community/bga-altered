<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Esmeralda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_11_C',
      'asset' => 'ALT_CORE_B_LY_11_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Esmeralda'),
      'type' => CHARACTER,
      'subtype' => ARTIST,
      'effectDesc' => clienttranslate('{M} $[RESUPPLY].'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(RESUPPLY, []),
    ];
  }
}
