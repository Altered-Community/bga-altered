<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_20_C',
      'asset' => 'ALT_CORE_B_MU_20_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Coniferal Coneman'),
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('{J} I become $[ANCHORED].'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
