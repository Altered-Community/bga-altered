<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_06_C',
      'asset' => 'ALT_CORE_B_MU_06_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Spindle Harvesters'),
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('{J} I become $[ANCHORED].'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
